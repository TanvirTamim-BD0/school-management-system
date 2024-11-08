<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Exam;
use App\Helpers\CurrentUser;
use App\Models\User;
use App\Helpers\DefaultSessionYear;

class CommonController extends Controller
{
    //To get allthe section data with classId...
    public function classWiseSection(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();
        $data = Section::where('class_id', $request->class_id)->where('user_id', $userId)->get();

        return response()->json($data);
    }
   
    //To get allthe section & subject data with classId...
    public function classWiseSectionAndSubject(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();
        $sectionData = Section::where('class_id', $request->class_Id)->where('user_id', $userId)->get();
        $subjectData = Subject::where('class_id', $request->class_Id)->where('user_id', $userId)->get();
        $data = [
            'sectionData' => $sectionData,
            'subjectData' => $subjectData
        ];
        return response()->json($data);
    }

    public function getStudentSectionIdWise(Request $request){

        //To get current user...
        $userId = CurrentUser::getUserId();
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();
        $studentData = Student::where('section_id', $request->section_Id)->where('session_year', $defaultSessionYear)->where('user_id', $userId)->get();

        return response()->json($studentData);
    }

    
    //To get all the student with classId & sectionId...
    public function classSectionWiseStudent(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();
        $data = Student::where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('session_year', $defaultSessionYear)->where('user_id', $userId)->get();

        return response()->json($data);
    }
    
    //To get all the user with roleId...
    public function roleWiseGetUser(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();
        
        //To get single roleData...
        $roleData = Role::where('id', $request->role_id)->first();
        
        //To get all the user data with roleId...
        $userData = User::where('role', $roleData->name)->where('admin_id', $userId)->get();
        return response()->json($userData);
    }

    //To get class and subject wise exam and student list...
    public function classAndSubjectWiseExamAndStudent(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To fetch all the exam data with class and subject...
        $examData = Exam::where('class_id', $request->class_id)->where('subject_id', $request->subject_id)
                ->where('user_id', $userId)->where('status', true)->get();
        
        //To fetch all the student data with class and section...
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();
        $studentData = Student::where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('session_year', $defaultSessionYear)->where('user_id', $userId)->get();

        $data = [
            'examData' => $examData,
            'studentData' => $studentData
        ];

        return response()->json($data);
    }

}
