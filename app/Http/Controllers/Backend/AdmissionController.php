<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admission;
use App\Helpers\CurrentUser;
use App\Models\Classname;
use App\Models\FeesAssign;

class AdmissionController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:admission-list|admission-create|admission-edit|admission-delete', ['only' => ['index','show']]);
         $this->middleware('permission:admission-create', ['only' => ['create','store']]);
         $this->middleware('permission:admission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:admission-delete', ['only' => ['destroy']]);
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

        //To get all the admission data...
        $admissions = Admission::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.admission.index' ,compact('admissions'));
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

        $classes = Classname::where('user_id', $userId)->get();
        return view('backend.admission.create',compact('classes'));
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
            'class_id'=> 'required',
            'admission_name'=> 'required',
            'fees'=> 'required',
            'available_days'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(Admission::create($data)){
            Toastr::success('Admission Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('admission.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      
         //To get current user...
        $userId = CurrentUser::getUserId();

        $classes = Classname::where('user_id', $userId)->get();
        $admission = Admission::find($id);

        return view('backend.admission.edit' , compact('admission','classes'));
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
            'class_id'=> 'required',
            'admission_name'=> 'required',
            'fees'=> 'required',
            'available_days'=> 'required',
        ]);

        $data = $request->all();

        $admission = Admission::find($id);
        if($admission->update($data)){
            Toastr::success('Admission Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('admission.index'))->with('message','Successfully Admission Updated');
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
        $admission = Admission::find($id);

        if($admission->delete()){
            Toastr::success('Admission Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('admission.index'))->with('message','Successfully Admission Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }


    public function classWiseFees(Request $request){

        $classId = $request->class_Id;
        $fees = FeesAssign::where('class_id',$classId)->first();
        
        return response()->json($fees);
    }

}
