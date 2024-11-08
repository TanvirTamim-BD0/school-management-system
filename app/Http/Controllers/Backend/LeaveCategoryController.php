<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LeaveCategory;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class LeaveCategoryController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:leave-category-list|leave-category-create|leave-category-edit|leave-category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:leave-category-create', ['only' => ['create','store']]);
         $this->middleware('permission:leave-category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:leave-category-delete', ['only' => ['destroy']]);
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

        //To get all the class data...
        $leaveCategoryData = LeaveCategory::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.leaveCategory.index' ,compact('leaveCategoryData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.leaveCategory.create');
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
            'leave_category'=> 'required'
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(LeaveCategory::create($data)){
            Toastr::success('LeaveCategory Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-category.index'));
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
        $singleLeaveCategoryData = LeaveCategory::find($id);
        return view('backend.leaveCategory.edit' , compact('singleLeaveCategoryData'));
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
            'leave_category'=> 'required'
        ]);

        $data = $request->all();
        $singleLeaveCategoryData = LeaveCategory::find($id);

        if($singleLeaveCategoryData->update($data)){
            Toastr::success('LeaveCategory Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-category.index'));
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
        $singleLeaveCategoryData = LeaveCategory::find($id);

        if($singleLeaveCategoryData->delete()){
            Toastr::success('LeaveCategory Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('leave-category.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
