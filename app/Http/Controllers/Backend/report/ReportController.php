<?php

namespace App\Http\Controllers\Backend\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Student;
use App\Models\TeacherAssign;
use App\Models\FeesAssign;
use App\Models\Subject;
use App\Models\StudentPayment;
use App\Helpers\CurrentUser;
use App\Models\ClassRutine;
use App\Models\LibraryBook;
use App\Models\StudentBookIssue;
use App\Models\Admission;
use App\Models\Teacher;
use Carbon\Carbon;
use App\Models\Contact;
use App\Helpers\DefaultSessionYear;

class ReportController extends Controller
{   


	//class report .....................
	public function classReport(){

		//To get current user...
		$userId = CurrentUser::getUserId();

		//To get all the class data...
		$classData = Classname::where('user_id', $userId)->get();

		return view('backend.report.classReport.filterClassReport',compact('classData'));
	}

	//class report filter ........
	public function classReportFilter(Request $request){

		$sectionData = Section::where('id',$request->section_id)->first();
		$studentCount = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->count();
		$teacherAssign = TeacherAssign::where('class_id',$request->class_id)->where('section_id',$request->section_id)->get();
		$fees = FeesAssign::where('class_id',$request->class_id)->first();
		$totalSubject = Subject::where('class_id',$request->class_id)->count();

		return view('backend.report.classReport.classReport',compact('sectionData','studentCount','teacherAssign','fees','totalSubject'));
	}

	//class invoice ........
	public function reportOfClassInvoice(Request $request){

		$sectionData = Section::where('id',$request->sectionId)->first();
		$studentCount = Student::where('class_id',$request->classId)->where('section_id',$request->sectionId)->count();
		$teacherAssign = TeacherAssign::where('class_id',$request->classId)->where('section_id',$request->sectionId)->get();
		$fees = FeesAssign::where('class_id',$request->classId)->first();
		$totalSubject = Subject::where('class_id',$request->classId)->count();

		$singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

		return view('backend.report.classReport.classReportInvoice',compact('sectionData','studentCount','teacherAssign','fees','totalSubject','invoiceData'));
	}



	// student report ...................
	public function studentReport(){
		//To get current user...
		$userId = CurrentUser::getUserId();

		//To get all the class data...
		$classData = Classname::where('user_id', $userId)->get();

		return view('backend.report.studentReport.filterStudentReport',compact('classData'));
	}

	public function studentReportFilter(Request $request){
		$defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();
		
		$studentData = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->where('session_year', $defaultSessionYear)->get();
		$student = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->first();
		return view('backend.report.studentReport.studentReport',compact('studentData','student'));
	}


	public function studentReportInvoice(Request $request){
		$studentData = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->get();
		$student = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->first();

		$singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

		return view('backend.report.studentReport.studentReportInvoice',compact('studentData','student','invoiceData'));

	}



	//class routine report ........................
	 public function classRoutineReport(){
		//To get current user...
		$userId = CurrentUser::getUserId();

		//To get all the class data...
		$classData = Classname::where('user_id', $userId)->get();

		return view('backend.report.classRoutineReport.filterRoutineReport',compact('classData'));
	}

	public function classRoutineReportFilter(Request $request){


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

		return view('backend.report.classRoutineReport.routineReport',compact('singleClassData','singleSectionData','saturdayData','sundayData','mondayData','tuesdayData','wednesdayData','thursdayData'));

	}

	public function classRoutineReportInvoice(Request $request){

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

		$singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

		return view('backend.report.classRoutineReport.routineReportInvoice',compact('singleClassData','singleSectionData','saturdayData','sundayData','mondayData','tuesdayData','wednesdayData','thursdayData','invoiceData'));

	}




	//library book report..........
	public function libraryBookReport(Request $request){

        //To get current user...
        $userId = CurrentUser::getUserId();

		//To get all the class data...
		$libraryBooks = LibraryBook::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.report.libraryBookReport.index' ,compact('libraryBooks','startDate','endDate'));

	}


    //library book issue report.........
    public function libraryBookIssueReport()
    {
		//To get current user...
		$userId = CurrentUser::getUserId();

		$startDate = Carbon::now()->subdays(30);
		$endDate = Carbon::now()->today()->toDateString();

		//To get all the class data...
		$studentBookIssueData = StudentBookIssue::orderBy('id', 'desc')->where('user_id', $userId)->whereBetween('created_at', [$startDate,$endDate])->where('status',1)->get();

		return view('backend.report.bookIssueReport.index' ,compact('studentBookIssueData','startDate','endDate'));
	}

	//filter book issue report.........
	public function filterBookIssue(Request $request){

		//To get current user...
		$userId = CurrentUser::getUserId();

		$startDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
		$endDate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');

		//To get all the class data...
		$studentBookIssueData = StudentBookIssue::orderBy('id', 'desc')->where('user_id', $userId)->whereBetween('created_at', [$startDate,$endDate])->where('status',1)->get();

		return view('backend.report.bookIssueReport.index' ,compact('studentBookIssueData','startDate','endDate'));
	}

	//book issue report invoice.........
	public function bookIssueReportInvoice(Request $request){

		//To get current user...
		$userId = CurrentUser::getUserId();

		$startDate = $request->startDate;
		$endDate = $request->endDate;

		//To get all the class data...
		$studentBookIssueData = StudentBookIssue::orderBy('id', 'desc')->where('user_id', $userId)->whereBetween('created_at', [$startDate,$endDate])->where('status',1)->get();

		$singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

		return view('backend.report.bookIssueReport.invoice' ,compact('studentBookIssueData','invoiceData'));

	}


	//addmission report ........
	public function addmissionReport(){

		//To get current user...
		$userId = CurrentUser::getUserId();

		//To get all the class data...
		$classData = Classname::where('user_id', $userId)->get();

		return view('backend.report.admissionReport.filterAdmissionReport',compact('classData'));
	}


	public function addmissionReportFilter(Request $request){

		$admissions = Admission::where('class_id',$request->class_id)->get();
		$classId = $request->class_id;
		return view('backend.report.admissionReport.admissionReport',compact('admissions','classId'));
	}

	public function addmissionReportInvoice(Request $request){

		$admissions = Admission::where('class_id',$request->class_id)->get();

		$singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

		return view('backend.report.admissionReport.admissionReportInvoice',compact('admissions','invoiceData'));

	}



	//student Attendence report ........
	public function studentAttendenceReportFilter(){

		//To get current user...
		$userId = CurrentUser::getUserId();

		//To get all the class data...
		$classData = Classname::where('user_id', $userId)->get();

		return view('backend.report.studentAttendenceReport.filterStudentAttendenceReport',compact('classData'));
	}


	public function studentAttendenceReport(Request $request){
		$startMotnhNumber = 0;
		while ($startMotnhNumber < 12) {
			$monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
			$startMotnhNumber++;
		}

		$student = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->where('id',$request->student_id)->first();

		return view('backend.report.studentAttendenceReport.studentAttendenceReport',compact('monthNames','student'));
	}

	//To get student attendance data...
    public function studentDaysAttendanceWithMonth(Request $request)
    {
        //To fetch student course information...
        $student = Student::where('id',$request->studentId)->first();
        
        $dates = [];
        $courseYear = Carbon::parse($student->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.report.studentAttendenceReport.daysAttendanceWithMonth' , compact('currentMonth','student','dates'));
    }
	
	//To get student attendance data...
    public function studentDaysAttendanceWithMonthReport(Request $request)
    {
        //To fetch student course information...
        $student = Student::where('id',$request->studentId)->first();
        
        $dates = [];
        $courseYear = Carbon::parse($student->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.report.studentAttendenceReport.daysAttendanceWithMonthReport' , compact('currentMonth','student','dates'));
    }

	public function studentAttendenceReportMonthInvoice(Request $request){

		$startMotnhNumber = 0;
		while ($startMotnhNumber < 12) {
			$monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
			$startMotnhNumber++;
		}

		$student = Student::where('class_id',$request->class_id)->where('section_id',$request->section_id)->where('id',$request->student_id)->first();
		$singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

		return view('backend.report.studentAttendenceReport.studentAttendenceReportMonthInvoice',compact('monthNames','student','invoiceData'));

	}


	public function studentAttendenceReportDayInvoice(Request $request){

		//To fetch student course information...
        $student = Student::where('id',$request->studentId)->first();
        
        $dates = [];
        $courseYear = Carbon::parse($student->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        $singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );
        return view('backend.report.studentAttendenceReport.studentAttendenceReportDayInvoice' , compact('currentMonth','student','dates','invoiceData'));
	}


	//teacher Attendence report ........
	public function teacherAttendenceReportFilter(){

		//To get current user...
		$userId = CurrentUser::getUserId();

		//To get all the class data...
		$teacherData = Teacher::where('user_id', $userId)->get();

		return view('backend.report.teacherAttendenceReport.filterTeacherAttendenceReport',compact('teacherData'));
	}


	public function teacherAttendenceReport(Request $request){
		
		$startMotnhNumber = 0;
		while ($startMotnhNumber < 12) {
			$monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
			$startMotnhNumber++;
		}
		$teacher = Teacher::where('id',$request->teacher_id)->first();

		return view('backend.report.teacherAttendenceReport.teacherAttendenceReport',compact('teacher','monthNames'));
	}


	//To get teacher attendance with month wise...
    public function teacherDaysAttendanceWithMonth(Request $request)
    {
        //To fetch student course information...
        $teacher = Teacher::where('id',$request->teacherId)->first();

        $dates = [];
        $courseYear = Carbon::parse($teacher->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.report.teacherAttendenceReport.daysAttendanceWithMonth' , compact('currentMonth','teacher','dates'));

    }   
	
	//To get teacher attendance with month wise...
    public function teacherDaysAttendanceWithMonthReport(Request $request)
    {
        //To fetch student course information...
        $teacher = Teacher::where('id',$request->teacherId)->first();

        $dates = [];
        $courseYear = Carbon::parse($teacher->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        return view('backend.report.teacherAttendenceReport.daysAttendanceWithMonthReport' , compact('currentMonth','teacher','dates'));

    }   


	public function teacherAttendenceReportMonthInvoice(Request $request){

		$startMotnhNumber = 0;
		while ($startMotnhNumber < 12) {
			$monthNames[] = date("F", strtotime("+$startMotnhNumber months"));
			$startMotnhNumber++;
		}
		$teacher = Teacher::where('id',$request->teacher_id)->first();

		$singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );


		return view('backend.report.teacherAttendenceReport.teacherAttendenceReportMonthInvoice',compact('teacher','monthNames','invoiceData'));

	}

	public function teacherAttendenceReportDayInvoice(Request $request){

		 //To fetch student course information...
        $teacher = Teacher::where('id',$request->teacherId)->first();

        $dates = [];
        $courseYear = Carbon::parse($teacher->created_at)->year;
        $monthPosition = Carbon::parse('1'. $request->monthName)->month;
        $dateNumber = Carbon::parse($request->monthName)->daysInMonth;
        $currentMonth = $request->monthName;
        
        //All days show...
        for($i=1; $i < $dateNumber + 1; ++$i) {
            $dates[] = Carbon::createFromDate($courseYear, $monthPosition, $i)->format('Y-m-d');
        }

        $singleContactInfoData = Contact::first();
		$todayDate = Carbon::now()->today()->toDateString();
		$invoiceData = array(
            'school_logo' => $singleContactInfoData->logo_image,
            'name' => $singleContactInfoData->name,
            'email' => $singleContactInfoData->email,
            'phone' => $singleContactInfoData->phone,
            'address' => $singleContactInfoData->address,
            'date' => $todayDate,
        );

        return view('backend.report.teacherAttendenceReport.teacherAttendenceReportDayInvoice' , compact('currentMonth','teacher','dates','invoiceData'));

	}




}
