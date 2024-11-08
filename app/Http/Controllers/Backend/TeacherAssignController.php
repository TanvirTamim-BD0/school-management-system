<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherAssign;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Auth;
use App\Helpers\CurrentUser;
use Brian2694\Toastr\Facades\Toastr;

class TeacherAssignController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:teacher-assign-list|teacher-assign-create|teacher-assign-edit|teacher-assign-delete', ['only' => ['index','show']]);
         $this->middleware('permission:teacher-assign-create', ['only' => ['create','store']]);
         $this->middleware('permission:teacher-assign-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:teacher-assign-delete', ['only' => ['destroy']]);
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

        $teacherAssigns = TeacherAssign::orderBy('id', 'desc')->where('user_id', $userId)->get();
        return view('backend.teacherAssign.index' ,compact('teacherAssigns'));
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
        $sections = Section::where('user_id', $userId)->get();
        $subjects = Subject::where('user_id', $userId)->get();
        $teachers = Teacher::where('user_id', $userId)->get();
        return view('backend.teacherAssign.create' ,compact('classes','subjects','sections','teachers'));
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
            'section_id'=> 'required',
            'subject_id'=> 'required',
            'teacher_id'=> 'required',
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if(TeacherAssign::create($data)){
            Toastr::success('Successfully Teacher Assign Added.', 'Success', ["progressbar" => true]);
           return redirect(route('assign-teacher.index'))->with('message','Successfully Teacher Assign Added');
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
        $teacherAssign = TeacherAssign::find($id);
        //To get current user...
        $userId = CurrentUser::getUserId();

        $classes = Classname::where('user_id', $userId)->get();
        $teachers = Teacher::where('user_id', $userId)->get();

        //To get all the section data with classId...
        $sectionData = Section::getAllTheSectionDataWithClassId($teacherAssign->class_id);
        $subjectData = Subject::getAllTheSubjectDataWithClassId($teacherAssign->class_id);

        return view('backend.teacherAssign.edit' ,compact('teacherAssign','classes','teachers','sectionData','subjectData'));
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
            'section_id'=> 'required',
            'subject_id'=> 'required',
            'teacher_id'=> 'required',
        ]);

        $data = $request->all();

        $teacherAssign = TeacherAssign::find($id);
        
        if($teacherAssign->update($data)){
            Toastr::success('Successfully Teacher Assign Updated.', 'Success', ["progressbar" => true]);
            return redirect(route('assign-teacher.index'))->with('message','Successfully Teacher Assign Updated');
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
        $teacherAssign = TeacherAssign::find($id);

        if($teacherAssign->delete()){
            Toastr::success('Successfully Teacher Assign Delete.', 'Success', ["progressbar" => true]);
            return redirect(route('assign-teacher.index'))->with('message','Successfully Teacher Assign Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }  
    }

}
