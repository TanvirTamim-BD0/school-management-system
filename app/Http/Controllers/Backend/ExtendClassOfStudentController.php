<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Student;
use App\Models\PreviousStudent;
use App\Models\DefaultSession;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use App\Models\Session;

class ExtendClassOfStudentController extends Controller
{
    //To get all the students data....
    public function getStudents()
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get current year...
        $currentYear = Carbon::now()->year;

        //To fetch single class, section & all class-data, all-section data...
        $classData = Classname::orderBy('id', 'asc')->where('user_id', $userId)->get();
        $singleClassData = Classname::orderBy('id', 'asc')->where('user_id', $userId)->first();
        $sectionData = Section::where('class_id', $singleClassData->id)->get();
        $singleSectionData = Section::where('class_id', $singleClassData->id)->orderBy('id', 'asc')->first();

        //To get all the student data...
        $studentData = Student::orderBy('id', 'desc')->where('user_id', $userId)->where('class_id', $singleClassData->id)
                    ->where('class_id', $singleSectionData->id)->where('session_year', '<' ,$currentYear)->get();

        return view('backend.extendClassOfStudent.index', compact('singleClassData','singleSectionData','classData','sectionData','studentData'));
    }
    
    //To get all the filter students data....
    public function filterStudents(Request $request)
    {
        $request->validate([
            'class_id'=> 'required',
            'section_id'=> 'required',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get current year...
        $currentYear = Carbon::now()->year;

        //To fetch single class, section & all class-data, all-section data...
        $classData = Classname::orderBy('id', 'asc')->where('user_id', $userId)->get();
        $singleClassData = Classname::where('id', $request->class_id)->first();
        $sectionData = Section::where('class_id', $singleClassData->id)->get();
        $singleSectionData = Section::where('class_id', $singleClassData->id)->where('id', $request->section_id)->first();

        //To get all the student data...
        $studentData = Student::orderBy('id', 'desc')->where('user_id', $userId)->where('class_id', $singleClassData->id)
                    ->where('section_id', $singleSectionData->id)->where('session_year', '<' ,$currentYear)->get();

        return view('backend.extendClassOfStudent.index', compact('singleClassData','singleSectionData','classData','sectionData','studentData'));
    }


    //To sift students in upper class...
    public function shiftStudents(Request $request)
    {
        $request->validate([
            'class_id'=> 'required',
            'section_id'=> 'required',
            'to_class_id'=> 'required',
            'to_section_id'=> 'required',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get current year...
        $currentYear = Carbon::now()->year;

        $classId = $request->class_id;
        $sectionId = $request->section_id;
        $toClassId = $request->to_class_id;
        $toSectionId = $request->to_section_id;

        //To get all the student & single student data...
        $studentData = Student::where('user_id', $userId)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->where('session_year', '<' ,$currentYear)->get();

        $getSingleStudentData = Student::where('user_id', $userId)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->where('session_year', '<' ,$currentYear)->first();

        //To fetch single previous student data...       
        $singlePreviousStudent = PreviousStudent::where('shifted_year', $currentYear)->where('user_id', $userId)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->first();

        //To check student is already exist in previousStudent or not...
        if(isset($singlePreviousStudent) && $singlePreviousStudent != null){
            Toastr::error('Error !! Already students shifted in this year.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }else{
            if(isset($studentData) && $studentData != null){
                foreach($studentData as $key=>$item){
                    //To add new previous student records...
                    $this->addNewPreviousStudent($item->id, $currentYear, $toClassId, $toSectionId);

                    //To update is_shifted for retired students...
                    if($toClassId == 'Out Of The School'){
                        //To add new student data...
                        $item->session_year = $currentYear; 
                        $item->is_shifted = true; 
                        $item->save();
                    }
                }

                Toastr::success('Student shifted successfully.', 'Error', ["progressbar" => true]);
                return redirect()->back();
            }
        }
    }

    //To add new previous student records...
    private function addNewPreviousStudent($studentId, $currentYear, $toClassId, $toSectionId)
    {
        //To fetch single student data...
        $singleStudentData = Student::where('id', $studentId)->first();
        
        //To set class, section & secctionyear...
        $classId = $singleStudentData->class_id;
        $sectionId = $singleStudentData->section_id;
        $sessionYear = $singleStudentData->session_year;

        //To check request to class...
        if($toClassId != 'Out Of The School'){
            //To add new student data...
            $singleStudentData->class_id = $toClassId;
            $singleStudentData->section_id = $toSectionId;
            $singleStudentData->group_id = $singleStudentData->group_id;
            $singleStudentData->session_year = $currentYear;
            $singleStudentData->save();
        }

        //To add new previous data...
        $data = new PreviousStudent();
        $data->user_id = $singleStudentData->user_id;
        $data->class_id = $classId;
        $data->section_id = $sectionId;
        $data->student_id = $singleStudentData->id;
        $data->session_year = $sessionYear;
        $data->shifted_year = $currentYear;
        $data->save();
    }


    /*
    *************************************
    For Default Session Section...
    *************************************
    */

    //To get default session page...
    public function defaultSession()
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get current year & sessionData...
        $currentYear = Carbon::now()->year;
        $sessionData = Session::where('user_id', $userId)->get();

        //To fetch single default session data...
        $defaultSessionData = DefaultSession::where('user_id', $userId)->first();

        return view('backend.defaultSession.index', compact('defaultSessionData','sessionData'));
    }
    
    //To update default session data...
    public function updateDefaultSession(Request $request)
    {
        $request->validate([
            'session_year'=> 'required',
        ]);

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To fetch single default session data...
        $defaultSessionData = DefaultSession::where('user_id', $userId)->first();

        //To check defaultSessionis avialable or not...
        if(isset($defaultSessionData) && $defaultSessionData != null){
            $defaultSessionData->session_year = $request->session_year;
            if($defaultSessionData->save()){
                Toastr::success('Default session updated successfully.', 'Error', ["progressbar" => true]);
                return redirect()->route('default-session');
            }else{
                Toastr::error('Something is wrong.!', 'Error', ["progressbar" => true]);
                return redirect()->route('default-session');
            }   
        }else{
            $data = $request->all();
            $data['user_id'] = $userId;
            if(DefaultSession::create($data)){
                Toastr::success('Default session created successfully.', 'Error', ["progressbar" => true]);
                return redirect()->route('default-session');
            }else{
                Toastr::error('Something is wrong.!', 'Error', ["progressbar" => true]);
                return redirect()->route('default-session');
            } 
        }

        
    }
}
