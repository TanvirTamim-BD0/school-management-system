<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Classname;
use App\Models\Teacher;
use App\Models\Guardian;
use App\Models\Notice;
use App\Helpers\CurrentUser;
use App\Models\StudentBookIssue;
use App\Models\ClassRutine;
use App\Models\Section;
use App\Models\Assignment;
use App\Models\TeacherAssign;
use App\Models\LeaveApply;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {      
        //To get current user...
        $userId = CurrentUser::getUserId();

        $teacher = Teacher::where('user_id', $userId)->count();
        $student = Student::where('user_id', $userId)->count();
        $guardian = Guardian::where('user_id', $userId)->count();
        $class = Classname::where('user_id', $userId)->count();

        $studentData = Student::orderBy('id', 'desc')->where('user_id', $userId)->limit(5)->get();
        $noticeData = Notice::orderBy('id', 'desc')->where('user_id', $userId)->limit(5)->get();
        $libararyBookData = StudentBookIssue::orderBy('id', 'desc')->where('student_id', $userId)->get();

        //To check user role is student, guardian or not...
        if(Auth::user()->role == 'student' || Auth::user()->role == 'guardian'){
            $userMobile = Auth::user()->mobile;
            if (Auth::user()->role == 'student') {
                $data = Student::where('student_phone',$userMobile)->first();
            }else{
                $gurdianData = Guardian::where('phone',$userMobile)->first();
                $data = Student::where('id',$gurdianData->student_id)->first();
            }
            
            //To fetch all the assignmentData of student...
            $getAllAssignmentData = Assignment::orderBy('id', 'asc')->where('class_id',$data->class_id)->get();
            $assignmentData = [];
            foreach($getAllAssignmentData as $item){
                if (isset($item) && $item !=null) {
                    //To decode assignment section_id & matching with student section id...
                    $sectionIds = json_decode($item->section_id);
                    if(in_array($data->section_id, $sectionIds)){
                        $assignmentData[] = $item;
                    }
                }
            }
        }else{
            $assignmentData = null;
        }


        if (Auth::user()->role == 'teacher') {
            $userMobile = Auth::user()->mobile;
            $teacherData = Teacher::where('teacher_phone',$userMobile)->first();
            $teacherAssign = TeacherAssign::orderBy('id', 'desc')->where('teacher_id', $teacherData->id)->get();
        }

        if (Auth::user()->role == 'teacher') {
            $teacherAssignData = $teacherAssign;
        }else{
            $teacherAssignData = [];
        }

        $leaveApplyData = LeaveApply::orderBy('id', 'desc')->where('leave_application_from', Auth::user()->id)->get();

        return view('backend.dashboard',compact('teacher','student','guardian','class','studentData','noticeData','libararyBookData','assignmentData','teacherAssignData','leaveApplyData'));
    }

    public function studentClassRutine($id){

        $student = Student::where('id', $id)->first();

        $classId = $student->class_id;
        $sectionId = $student->section_id;

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


    public function upComingNotice(){

        $todayDate = Carbon::now()->today()->toDateString();
        
        $noticeData = Notice::whereDate('date', '<=', $todayDate)->get();
        return view('backend.dahsboardNotice',compact('noticeData'));
    }


    public function logout()
    {
         Auth::guard('web')->logout();
         return Redirect()->route('login');
    }
    
}
