<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Response;
use App\Models\Assignment;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Subject;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class AssignmentController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:assignment-list|assignment-create|assignment-edit|assignment-delete', ['only' => ['index','show']]);
         $this->middleware('permission:assignment-create', ['only' => ['create','store']]);
         $this->middleware('permission:assignment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:assignment-delete', ['only' => ['destroy']]);
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
        $assignmentData = Assignment::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.assignment.index' ,compact('assignmentData'));
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

        //To get all the class data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.assignment.create', compact('classData'));
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
            'title'=> 'required',
            'description'=> 'required',
            'assignment_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
        ]);

        $data = $request->all();

        $deadLine = $request->deadline;
        $deadLineMark = Carbon::createFromFormat('d/m/Y', $deadLine)->format('Y-m-d');
        $data['deadline'] = $deadLineMark;

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        //To json encoded...
        $sectionId = json_encode($request->section_id);
        $data['section_id'] = $sectionId;

        // For assignment description title...
        $blogRemovalDescription = strip_tags($request->description);
        $originalBlogDescription = preg_replace("/\s|&nbsp;/"," ",$blogRemovalDescription);
        $data['solid_description'] = $originalBlogDescription;

        //To check file..
        if($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/assignmentFile'), $fileName);
            $data['assignment_file'] = $fileName;
        }
        
        if(Assignment::create($data)){
            Toastr::success('Assignment Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('assignment.index'));
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
        $singleAssignmentData = Assignment::where('id', $id)->first();

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
        
        //To get all the section data with classId...
        $sectionData = Section::getAllTheSectionDataWithClassId($singleAssignmentData->class_id);
        $subjectData = Subject::getAllTheSubjectDataWithClassId($singleAssignmentData->class_id);

        $singleDeadline = Carbon::createFromFormat('Y-m-d', $singleAssignmentData->deadline)->format('d/m/Y');
        return view('backend.assignment.edit', compact('singleAssignmentData','classData','sectionData','subjectData','singleDeadline'));
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
            'title'=> 'required',
            'description'=> 'required',
            'assignment_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
        ]);

        $data = $request->all();

        $deadLine = $request->deadline;
        $deadLineMark = Carbon::createFromFormat('d/m/Y', $deadLine)->format('Y-m-d');
        $data['deadline'] = $deadLineMark;
        
        //To fetch single assignment data...
        $singleAssignmentData = Assignment::where('id', $id)->first();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        //To json encoded...
        $sectionId = json_encode($request->section_id);
        $data['section_id'] = $sectionId;

        // For assignment description title...
        $blogRemovalDescription = strip_tags($request->description);
        $originalBlogDescription = preg_replace("/\s|&nbsp;/"," ",$blogRemovalDescription);

        $data['solid_description'] = $originalBlogDescription;

        //To check file..
        if($request->hasFile('assignment_file')) {
            if  (file_exists(public_path('backend/uploads/assignmentFile/'.$singleAssignmentData->assignment_file))) {
                unlink(public_path('backend/uploads/assignmentFile/'.$singleAssignmentData->assignment_file));
            }
            
            $file = $request->file('assignment_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/assignmentFile'), $fileName);
            $data['assignment_file'] = $fileName;
        }
        
        if($singleAssignmentData->update($data)){
            Toastr::success('Assignment Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('assignment.index'));
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
        $data = Assignment::where('id', $id)->first();

        //To check file is available or not...
        if  (file_exists(public_path('backend/uploads/assignmentFile/'.$data->assignment_file))) {
            unlink(public_path('backend/uploads/assignmentFile/'.$data->assignment_file));
        }

        if($data->delete()){
            Toastr::success('Assignment Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('assignment.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    //to download assignment file...
    public function assignmentFileDdownload($assignmentId)
    {
        $data = Assignment::where('id', $assignmentId)->first();
        if(file_exists(public_path('backend/uploads/assignmentFile/'.$data->assignment_file))) {
            $path = public_path('backend/uploads/assignmentFile/'.$data->assignment_file);

            $fileName = 'assignmentFile.zip';
            return Response::download($path);
        }else{
            Toastr::error('Sorry File Not Exist.!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
        
    }
}
