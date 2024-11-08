<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classname;
use App\Models\Exam;
use App\Models\Result;
use App\Helpers\CurrentUser;

class ResultController extends Controller
{
    //To get all student result filter page...
    public function allStudentResultFilter()
    {
         //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data...
        $classData = Classname::where('user_id', $userId)->get();
        $examData = Exam::where('user_id', $userId)->get();

        return view('backend.result.allStudentFilterResult',compact('classData','examData'));
    }

    //To get all student result...
    public function getAllStudentResult(Request $request)
    {
        $resultData = Result::where('class_id',$request->class_id)->where('section_id',$request->section_id)
                    ->where('exam_id',$request->exam_id)->get();
    
        return view('backend.result.allStudentViewResult',compact('resultData'));
    }
    
    //To get single student result filter page...
    public function resultFilter()
    {
         //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data...
        $classData = Classname::where('user_id', $userId)->get();
        $examData = Exam::where('user_id', $userId)->get();

        return view('backend.result.filterResult',compact('classData','examData'));
    }

    //To get single student result...
    public function getSingleStudentResult(Request $request)
    {
        $resultData = Result::where('class_id',$request->class_id)->where('section_id',$request->section_id)
                    ->where('exam_id',$request->exam_id)->where('student_id',$request->student_id)->first();

        return view('backend.result.viewResult',compact('resultData'));
    }

}
