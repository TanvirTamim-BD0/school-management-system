<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Classname;
use Auth;
use App\Helpers\CurrentUser;
use Brian2694\Toastr\Facades\Toastr;

class SectionController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:section-list|section-create|section-edit|section-delete', ['only' => ['index','show']]);
         $this->middleware('permission:section-create', ['only' => ['create','store']]);
         $this->middleware('permission:section-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:section-delete', ['only' => ['destroy']]);
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

        $sections = Section::orderBy('id', 'desc')->where('user_id', $userId)->get();
        return view('backend.section.index' ,compact('sections'));
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
        return view('backend.section.create' ,compact('classes'));
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
            'section_name'=> 'required',
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if(Section::create($data)){
            Toastr::success('Section Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('section.index'))->with('message','Successfully Section Added');
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
        //To get current user...
        $userId = CurrentUser::getUserId();

        $section = Section::find($id);
        
        $classes = Classname::where('user_id', $userId)->get();
        return view('backend.section.edit' , compact('section','classes'));
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
            'section_name'=> 'required',
        ]);

        $data = $request->all();

        $section = Section::find($id);
        if($section->update($data)){
            Toastr::success('Section Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('section.index'))->with('message','Successfully Section Updated');
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
        $section = Section::find($id);

        if($section->delete()){
            Toastr::success('Section Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('section.index'))->with('message','Successfully Section Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }  
    }
    
}
