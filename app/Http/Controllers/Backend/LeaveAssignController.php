<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use App\Models\LeaveCategory;
use App\Models\LeaveAssign;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class LeaveAssignController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:leave-assign-list|leave-assign-create|leave-assign-edit|leave-assign-delete', ['only' => ['index','show']]);
         $this->middleware('permission:leave-assign-create', ['only' => ['create','store']]);
         $this->middleware('permission:leave-assign-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:leave-assign-delete', ['only' => ['destroy']]);
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

        //To get all the leaveAssign data...
        $leaveAssignData = LeaveAssign::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.leaveAssign.index' ,compact('leaveAssignData'));
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
        $roleData = Role::whereNotIn('name', ['superadmin'])->get();

        return view('backend.leaveAssign.create', compact('leaveCategoryData','roleData'));
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
            'no_of_days'=> 'required'
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(LeaveAssign::create($data)){
            Toastr::success('LeaveAssign Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-assign.index'));
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
        $singleLeaveAssignData = LeaveAssign::find($id);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the leaveCategory & role data...
        $leaveCategoryData = LeaveCategory::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $roleData = Role::whereNotIn('name', ['superadmin'])->get();
        
        return view('backend.leaveAssign.edit' , compact('singleLeaveAssignData','leaveCategoryData','roleData'));
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
            'no_of_days'=> 'required'
        ]);

        $data = $request->all();
        $singleLeaveAssignData = LeaveAssign::find($id);

        if($singleLeaveAssignData->update($data)){
            Toastr::success('LeaveAssign Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-assign.index'));
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
        $singleLeaveAssignData = LeaveAssign::find($id);

        if($singleLeaveAssignData->delete()){
            Toastr::success('LeaveAssign Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-assign.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
