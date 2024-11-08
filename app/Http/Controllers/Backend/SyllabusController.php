<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Response;
use App\Models\Syllabus;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Subject;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class SyllabusController extends Controller
{   
    function __construct()
    {
        $this->middleware('permission:syllabus-list|syllabus-create|syllabus-edit|syllabus-delete', ['only' => ['index','show']]);
         $this->middleware('permission:syllabus-create', ['only' => ['create','store']]);
         $this->middleware('permission:syllabus-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:syllabus-delete', ['only' => ['destroy']]);
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
        $syllabusData = Syllabus::orderBy('id', 'desc')->where('user_id', $userId)->get();
        
        return view('backend.syllabus.index' ,compact('syllabusData'));
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

        return view('backend.syllabus.create', compact('classData'));
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
            'title'=> 'required',
            'description'=> 'required',
            'syllabus_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        // For syllabus description title...
        $blogRemovalDescription = strip_tags($request->description);
        $originalBlogDescription = preg_replace("/\s|&nbsp;/"," ",$blogRemovalDescription);

        $data['solid_description'] = $originalBlogDescription;

        //To check file..
        if($request->hasFile('syllabus_file')) {
            $file = $request->file('syllabus_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/syllabusFile'), $fileName);
            $data['syllabus_file'] = $fileName;
        }
        
        if(Syllabus::create($data)){
            Toastr::success('Syllabus Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('syllabus.index'));
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
        $singleSyllabusData = Syllabus::where('id', $id)->first();

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.syllabus.edit', compact('singleSyllabusData','classData'));
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
            'title'=> 'required',
            'description'=> 'required',
            'syllabus_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
        ]);

        $data = $request->all();
        $singleSyllabusData = Syllabus::where('id', $id)->first();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        // For syllabus description title...
        $blogRemovalDescription = strip_tags($request->description);
        $originalBlogDescription = preg_replace("/\s|&nbsp;/"," ",$blogRemovalDescription);

        $data['solid_description'] = $originalBlogDescription;

        //To check file..
        if($request->hasFile('syllabus_file')) {
            if  (file_exists(public_path('backend/uploads/syllabusFile/'.$singleSyllabusData->syllabus_file))) {
                unlink(public_path('backend/uploads/syllabusFile/'.$singleSyllabusData->syllabus_file));
            }
            
            $file = $request->file('syllabus_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/syllabusFile'), $fileName);
            $data['syllabus_file'] = $fileName;
        }
        
        if($singleSyllabusData->update($data)){
            Toastr::success('Syllabus Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('syllabus.index'));
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
        $data = Syllabus::where('id', $id)->first();
        if(file_exists(public_path('backend/uploads/syllabusFile/'.$data->syllabus_file))) {
            unlink(public_path('backend/uploads/syllabusFile/'.$data->syllabus_file));
        }
        if($data->delete()){
            Toastr::success('Syllabus Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('syllabus.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    //to download assignment file...
    public function syllabusFileDownload($assignmentId)
    {
        $data = Syllabus::where('id', $assignmentId)->first();
        if(file_exists(public_path('backend/uploads/syllabusFile/'.$data->syllabus_file))) {
            $path = public_path('backend/uploads/syllabusFile/'.$data->syllabus_file);

            return Response::download($path);
        }else{
            Toastr::error('Sorry File Not Exist.!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
        
    }
}
