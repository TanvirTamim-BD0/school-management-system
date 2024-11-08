<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use DateTime;
use App\Helpers\DefaultSessionYear;

class AttendanceOfStudentController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:attendace-of-student-list|attendace-of-student-create|attendace-of-student-edit|attendace-of-student-delete', ['only' => ['index','show']]);
         $this->middleware('permission:attendace-of-student-create', ['only' => ['create','store']]);
         $this->middleware('permission:attendace-of-student-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:attendace-of-student-delete', ['only' => ['destroy']]);
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
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();

        //To get all the class & student data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $studentData = Student::orderBy('id', 'desc')->where('session_year', $defaultSessionYear)->where('user_id', $userId)->get();

        return view('backend.attendance.studentAttendace.index', compact('classData','studentData'));
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
        $date = Carbon::now()->today()->toDateString();
        $todayDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');

        //To get all the class & student data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.attendance.studentAttendace.create', compact('classData','todayDate'));
    }

    //To get student filter data...
    public function getStudentFilterDataForAttendance(Request $request)
    {
        $classId = $request->class_id;
        $sectionId = $request->section_id;
        $selectedDate = $request->date;

        //To get class and section data...
        $singleClassData = Classname::getSingleClassData($classId);
        $singleSectionData = Section::getSingleSectionData($sectionId);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get today date & format of selected date...
        $todayDate = Carbon::now()->today()->toDateString();
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $selectedDate)->format('Y-m-d');
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();

        //To check selected date with today date...
        if($selectedFormatDate <= $todayDate){
            //To check studentAttendance is available or not with date....
            $data = StudentAttendance::where('date', $selectedFormatDate)->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)->where('user_id', $userId)->first();

            //To get all the studentAttendance data...
            $stdentAttendanceData = StudentAttendance::where('date', $selectedFormatDate)->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)->where('user_id', $userId)->get();

            if(isset($data) && $data != null){
                //To get all the class & student data with userId...
                $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
                $studentData = $stdentAttendanceData;

                return view('backend.attendance.studentAttendace.filterStudentDataForAttendanceUpdate', compact('classData','selectedDate'
                ,'singleClassData','singleSectionData','studentData','classId','sectionId','data'));
            }else{
                //To get all the class & student data with userId...
                $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
                $studentData = Student::orderBy('id', 'desc')->where('user_id', $userId)->where('class_id', $classId)
                                ->where('section_id', $sectionId)->where('session_year', $defaultSessionYear)->get();

                return view('backend.attendance.studentAttendace.filterStudentDataForAttendance', compact('classData','selectedDate'
                ,'singleClassData','singleSectionData','studentData','classId','sectionId'));
            }
        }else{
            Toastr::error('You can not select date greater than today date.!', '', ["progressbar" => true]);
            return redirect()->back();
        }
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
            'class_id' => 'required',
            'section_id' => 'required',
            'student_id' => 'required',
            'date' => 'required'
        ]);

        //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();

        //To check student is avaiable or not...
        if(isset($request->student_id)){
            foreach ($request->student_id as $key => $value){
                $data = new StudentAttendance();
                //To get current user...
                $userId = CurrentUser::getUserId();
                $data['user_id'] = $userId;

                $data['class_id'] = $request->class_id;
                $data['section_id'] = $request->section_id;
                $data['student_id'] = $value;

                //To check empty or not....
                if($request->attendance[$value] == 'absence'){
                    $data['absence'] = 1;
                }
                else if($request->attendance[$value] == 'late'){
                    $data['late'] = 1;
                }
                else if($request->attendance[$value] == 'leave'){
                    $data['leave'] = 1;
                }
                else if($request->attendance[$value] == 'present'){
                    $data['present'] = 1;
                }
                //Current date to fetch....
                $date = Carbon::now();

                //To formate of selected date...
                $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

                $data['date'] = $selectedFormatDate;
                $data['month'] = date('F', strtotime($selectedFormatDate));
                $date_arr = explode("-", $selectedFormatDate);
                $data['year'] = $date_arr[0];
                $data->save();
            }

            Toastr::success('Attendance Created Successfully.', '', ["progressbar" => true]);
            return redirect()->route('attendace-of-student.index');
        }else{
            Toastr::error('You have no student data.!', '', ["progressbar" => true]);
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
        //
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
            'class_id' => 'required',
            'section_id' => 'required',
            'student_id' => 'required',
            'date' => 'required'
        ]);

        //To get userId....
        $data = StudentAttendance::where('id', $id)->first();
        $userId = $data->user_id;

        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        if(isset($request->student_id)){
            foreach ($request->student_id as $key => $value) {

                $data = StudentAttendance::where('class_id', $request->class_id)->where('section_id', $request->section_id)
                ->where('date', $selectedFormatDate)->where('student_id',$value)->where('user_id', $userId)->first();

                //To check empty or not....
                if($request->attendance[$value] == 'absence'){
                    $data['absence'] = 1;
                }else{
                    $data['absence'] = 0;
                }
                if($request->attendance[$value] == 'late'){
                    $data['late'] = 1;
                }else{
                    $data['late'] = 0;
                }
                if($request->attendance[$value] == 'leave'){
                    $data['leave'] = 1;
                }else{
                    $data['leave'] = 0;
                }
                if($request->attendance[$value] == 'present'){
                    $data['present'] = 1;
                }else{
                    $data['present'] = 0;
                }

                $data->save();
            }
        }

        Toastr::success('Attendance Update Successfully!.');
        return redirect()->route('attendace-of-student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //To get student filter data...
    public function getStudentFilterData(Request $request)
    {
        $classId = $request->class_id;
        $sectionId = $request->section_id;

        //To get current user...
        $userId = CurrentUser::getUserId();
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();

        //To get all the class & student data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $sectionData = Section::where('user_id', $userId)->where('class_id', $classId)->get();
        $studentData = Student::orderBy('id', 'desc')->where('user_id', $userId)->where('session_year', $defaultSessionYear)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->get();

        return view('backend.attendance.studentAttendace.filterStudentData', compact('classData','sectionData','studentData','classId','sectionId'));
    }
}
