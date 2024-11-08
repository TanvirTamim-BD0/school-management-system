<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Models\LeaveApply;
use App\Models\LeaveCategory;
use App\Models\LeaveAssign;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class LeaveApplyController extends Controller
{   
    function __construct()
    {
         $this->middleware('permission:leave-apply-list|leave-apply-create|leave-apply-edit|leave-apply-delete', ['only' => ['index','show']]);
         $this->middleware('permission:leave-apply-create', ['only' => ['create','store']]);
         $this->middleware('permission:leave-apply-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:leave-apply-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the LeaveApply data...
        $leaveApplyData = LeaveApply::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.leaveApply.index', compact('leaveApplyData'));
    }


    //admin application list.............
    public function leaveApplicationList(){

        //To get all the LeaveApply data...
        $leaveApplicationData = LeaveApply::orderBy('id', 'desc')->get();

        return view('backend.leaveApply.applicationList', compact('leaveApplicationData'));
    }


    //admin application declined.............
    public function leaveApplicationDeclined($id){

        $leaveApplication = LeaveApply::where('id', $id)->first();
        $leaveApplication->status = false;
        $leaveApplication->save();

        Toastr::success('Leave Application Declined.', 'Success', ["progressbar" => true]);
        return redirect(route('leave-application-list'));
    }


    //admin application approve.............
    public function leaveApplicationApprove($id){

        $leaveApplication = LeaveApply::where('id', $id)->first();
        $leaveApplication->status = true;
        $leaveApplication->save();

        Toastr::success('Leave Application Successfully Approve.', 'Success', ["progressbar" => true]);
        return redirect(route('leave-application-list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the leaveCategory & role data...
        $leaveCategoryData = LeaveCategory::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $roleData = Role::whereNotIn('name', ['superadmin','guardian'])->get();

        return view('backend.leaveApply.create', compact('leaveCategoryData','roleData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id'=> 'required',
            'leave_category_id'=> 'required',
            'leave_application_to'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'reason'=> 'required',
            'attachment_file'=> 'nullable'
        ]);

        $data = $request->all();

        //To formate of selected date...
        $start = $request->start_date;
        $end = $request->end_date;
        $startDate = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
        $data['start_date'] = $startDate;
        $endDate = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
        $data['end_date'] = $endDate;

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        $data['leave_application_from'] = Auth::user()->id;

        //To check file..
        if($request->hasFile('attachment_file')) {
            $file = $request->file('attachment_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/leaveApplyFile'), $fileName);
            $data['attachment_file'] = $fileName;
        }

        if(LeaveApply::create($data)){
            Toastr::success('LeaveApply Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-apply.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singleLeaveApplyData = LeaveApply::find($id);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the leaveCategory & role data...
        $leaveCategoryData = LeaveCategory::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $roleData = Role::whereNotIn('name', ['superadmin','teacher','guardian','student'])->get();

        return view('backend.leaveApply.edit' , compact('singleLeaveApplyData','leaveCategoryData'
                    ,'roleData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id'=> 'required',
            'leave_category_id'=> 'required',
            'leave_application_to'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'reason'=> 'required',
            'attachment_file'=> 'nullable'
        ]);

        $data = $request->all();
        $singleLeaveApplyData = LeaveApply::find($id);

        //To formate of selected date...
        $start = $request->start_date;
        $end = $request->end_date;
        $startDate = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
        $data['start_date'] = $startDate;
        $endDate = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
        $data['end_date'] = $endDate;

        //To check file..
        if($request->hasFile('attachment_file')) {
            if  (file_exists(public_path('backend/uploads/leaveApplyFile/'.$singleLeaveApplyData->attachment_file))) {
                unlink(public_path('backend/uploads/leaveApplyFile/'.$singleLeaveApplyData->attachment_file));
            }

            $file = $request->file('attachment_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/leaveApplyFile'), $fileName);
            $data['attachment_file'] = $fileName;
        }

        if($singleLeaveApplyData->update($data)){
            Toastr::success('LeaveApply Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-apply.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $singleLeaveApplyData = LeaveApply::find($id);

        // To check event file is avaiable or not...
        if($singleLeaveApplyData->attachment_file != null && file_exists(public_path('backend/uploads/leaveApplyFile/'.$singleLeaveApplyData->attachment_file))) {
            unlink(public_path('backend/uploads/leaveApplyFile/'.$singleLeaveApplyData->attachment_file));
        }

        if($singleLeaveApplyData->delete()){
            Toastr::success('LeaveApply Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-apply.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
