<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\FeesType;
use App\Models\FeesAssign;
use App\Models\Classname;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class FeesAssignController extends Controller
{   
    function __construct()
    {
         $this->middleware('permission:fees-assign-list|fees-assign-create|fees-assign-edit|fees-assign-delete', ['only' => ['index','show']]);
         $this->middleware('permission:fees-assign-create', ['only' => ['create','store']]);
         $this->middleware('permission:fees-assign-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:fees-assign-delete', ['only' => ['destroy']]);
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

        //To get all the FeesAssign data...
        $feesAssignData = FeesAssign::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.feesAssign.index', compact('feesAssignData'));
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

        //To get all the FeesType & Class data...
        $feesTypeData = FeesType::orderBy('id', 'asc')->where('user_id', $userId)->get();
        $classData = Classname::orderBy('id', 'asc')->where('user_id', $userId)->get();

        return view('backend.feesAssign.create', compact('feesTypeData','classData'));
    }

    //To get all the fees type data with classId...
    public function classWiseFeesType(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();
        $feesTypeIds = FeesAssign::where('user_id', $userId)->where('class_id', $request->class_id)
                    ->select('fees_type_id')->pluck('fees_type_id');

        //To check feesTypeIds is avaiable or not...
        if((isset($feesTypeIds)) && $feesTypeIds != null){
            $data = FeesType::where('user_id', $userId)->whereNotIn('id', $feesTypeIds)->get();
        }else{
            $data = FeesType::where('user_id', $userId)->whereNotIn('id', $feesTypeIds)->get();
        }

        return response()->json($data);
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
            'fees_type_id'=> 'required',
            'class_id'=> 'required',
            'fees_amount'=> 'required'
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(FeesAssign::create($data)){
            Toastr::success('FeesAssign Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('fees-assign.index'));
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
        $singleFeesAssignData = FeesAssign::find($id);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the FeesType & Class data...
        $feesTypeData = FeesType::orderBy('id', 'asc')->where('user_id', $userId)->get();
        $classData = Classname::orderBy('id', 'asc')->where('user_id', $userId)->get();

        //To get all the selected fees assign type data...
        $feesTypeIds = FeesAssign::where('user_id', $singleFeesAssignData->user_id)->where('fees_type_id','!=', $singleFeesAssignData->fees_type_id)
                ->select('fees_type_id')->pluck('fees_type_id');

        $selectedFeesTypeIds = $feesTypeIds->toArray();

        return view('backend.feesAssign.edit', compact('singleFeesAssignData','feesTypeData','classData','selectedFeesTypeIds'));
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
            'fees_type_id'=> 'required',
            'class_id'=> 'required',
            'fees_amount'=> 'required'
        ]);

        $data = $request->all();
        $singleFeesAssignData = FeesAssign::find($id);

        if($singleFeesAssignData->update($data)){
            Toastr::success('FeesAssign Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('fees-assign.index'));
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
        $singleFeesAssignData = FeesAssign::find($id);

        if($singleFeesAssignData->delete()){
            Toastr::success('FeesAssign Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('fees-assign.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
