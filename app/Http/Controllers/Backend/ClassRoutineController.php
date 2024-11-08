<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\ClassRutine;
use App\Models\Classname;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Room;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use DateTime;
use App\Models\Subject;

class ClassRoutineController extends Controller
{   
     function __construct()
    {
        $this->middleware('permission:class-routine-list|class-routine-create|class-routine-edit|class-routine-delete', ['only' => ['index','show']]);
         $this->middleware('permission:class-routine-create', ['only' => ['create','store']]);
         $this->middleware('permission:class-routine-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:class-routine-delete', ['only' => ['destroy']]);
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
        $date = Carbon::now()->today()->toDateString();
        $todayDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');

        //To get all the class & student data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.classRutine.index',compact('classData','todayDate'));
    }


    public function classRutineGet(Request $request){

        $classId = $request->class_id;
        $sectionId = $request->section_id;

        //To get class and section data...
        $singleClassData = Classname::getSingleClassData($classId);
        $singleSectionData = Section::getSingleSectionData($sectionId);

        $saturdayData = ClassRutine::where('day','saturday')->where('class_id',$classId)->where('section_id',$sectionId)->get();
        $sundayData = ClassRutine::where('day','sunday')->where('class_id',$classId)->where('section_id',$sectionId)->get();
        $mondayData = ClassRutine::where('day','monday')->where('class_id',$classId)->where('section_id',$sectionId)->get();
        $tuesdayData = ClassRutine::where('day','tuesday')->where('class_id',$classId)->where('section_id',$sectionId)->get();
        $wednesdayData = ClassRutine::where('day','wednesday')->where('class_id',$classId)->where('section_id',$sectionId)->get();
        $thursdayData = ClassRutine::where('day','thursday')->where('class_id',$classId)->where('section_id',$sectionId)->get();

        return view('backend.classRutine.filterRutineData',compact('singleClassData','singleSectionData','saturdayData','sundayData','mondayData','tuesdayData','wednesdayData','thursdayData'));
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
        $teacherData = Teacher::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $roomData = Room::orderBy('id', 'desc')->where('user_id', $userId)->get();

        //To store all the year name...
        $startYearNumber = 2000;
        while ($startYearNumber <= 2100) {
            $yearData[] = $startYearNumber;
            $startYearNumber++;
        }
        $currentYear = date('Y');

        return view('backend.classRutine.create' ,compact('classData','teacherData','roomData','yearData','currentYear'));
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
            'room_id'=> 'required',
            'year'=> 'required',
            'day'=> 'required',
            'starting_time'=> 'required',
            'ending_time'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        
        //To formattinh start and ending time...
        $formateStartTime = date('H:i:s', strtotime($request->starting_time));
        $formateEndTime = date('H:i:s', strtotime($request->ending_time));
        $data['starting_time'] = $formateStartTime;
        $data['ending_time'] = $formateEndTime;

        $startTimecheck = ClassRutine::where('day',$request->day)->whereTime('starting_time','<=',$request->starting_time)->whereTime('ending_time','>',$request->starting_time)->first();
        if(isset($startTimecheck) && $startTimecheck != null){
            Toastr::error('Already class booked in this time frame.!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }else{
            $endTimeCheck = ClassRutine::where('day',$request->day)->whereTime('starting_time','<',$request->ending_time)->whereTime('ending_time','>',$request->ending_time)->first();
            if(isset($endTimeCheck) && $endTimeCheck != null){
                Toastr::error('Already class booked in this time frame.!.', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }else{
                if(ClassRutine::create($data)){
                   Toastr::success('Class Rutine Created Successfully.', 'Success', ["progressbar" => true]);
                   return redirect(route('classRoutine.index'));
                }else{
                    Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
                    return redirect()->back();
                }
            }
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
        $singleClassRutineData = ClassRutine::where('id', $id)->first();

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To store all the year name...
        $startYearNumber = 2000;
        while ($startYearNumber <= 2100) {
            $yearData[] = $startYearNumber;
            $startYearNumber++;
        }

        //To get all the class data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
        
        $teacherData = Teacher::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $roomData = Room::orderBy('id', 'desc')->where('user_id', $userId)->get();

        //To get all the section data with classId...
        $sectionData = Section::getAllTheSectionDataWithClassId($singleClassRutineData->class_id);
        $subjectData = Subject::getAllTheSubjectDataWithClassId($singleClassRutineData->class_id);

        //To formattinh start and ending time...
        $formateStartTime = date('h:i A', strtotime($singleClassRutineData->starting_time));
        $formateEndTime = date('h:i A', strtotime($singleClassRutineData->ending_time));

        return view('backend.classRutine.edit', compact('singleClassRutineData','classData','sectionData'
        ,'subjectData','teacherData','roomData','yearData','formateStartTime','formateEndTime'));
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
            'room_id'=> 'required',
            'year'=> 'required',
            'day'=> 'required',
            'starting_time'=> 'required',
            'ending_time'=> 'required',
        ]);

        $data = $request->all();

        //To formattinh start and ending time...
        $formateStartTime = date('H:i:s', strtotime($request->starting_time));
        $formateEndTime = date('H:i:s', strtotime($request->ending_time));
        $data['starting_time'] = $formateStartTime;
        $data['ending_time'] = $formateEndTime;

        $classRutine = ClassRutine::find($id);
        if($classRutine->update($data)){
            Toastr::success('Class Routine Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('classRoutine.index'))->with('message','Successfully Class Routine Updated');
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
        $rutine = ClassRutine::find($id);

        if($rutine->delete()){
            Toastr::success('Class Rutine Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('classRoutine.index'))->with('message','Successfully Class Rutine Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }

}
