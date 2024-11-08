<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Classname;
use Auth;
use App\Helpers\CurrentUser;
use Brian2694\Toastr\Facades\Toastr;

class SubjectController extends Controller
{   
    function __construct()
    {
         $this->middleware('permission:subject-list|subject-create|subject-edit|subject-delete', ['only' => ['index','show']]);
         $this->middleware('permission:subject-create', ['only' => ['create','store']]);
         $this->middleware('permission:subject-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:subject-delete', ['only' => ['destroy']]);
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

        $subjects = Subject::orderBy('id', 'desc')->where('user_id', $userId)->get();
        return view('backend.subject.index' ,compact('subjects'));
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
        return view('backend.subject.create' ,compact('classes'));
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
            'subject_name'=> 'required',
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if(Subject::create($data)){
            Toastr::success('Subject Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('subject.index'))->with('message','Successfully Subject Added');
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
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
        $subject = Subject::find($id);
        
        //To get current user...
        $userId = CurrentUser::getUserId();
        
        $classes = Classname::where('user_id', $userId)->get();
        return view('backend.subject.edit' , compact('subject','classes'));
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
            'subject_name'=> 'required',
        ]);

        $data = $request->all();

        $subject = Subject::find($id);
        if($subject->update($data)){
            Toastr::success('Subject Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('subject.index'))->with('message','Successfully Subject Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
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
        $subject = Subject::find($id);

        if($subject->delete()){
            Toastr::success('Subject Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('subject.index'))->with('message','Successfully Subject Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }  
    }

}