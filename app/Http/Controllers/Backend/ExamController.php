<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Exam;
use App\Helpers\CurrentUser;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Result;
use Auth;
use Carbon\Carbon;
use App\Helpers\DefaultSessionYear;

class ExamController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:exam-list|exam-create|exam-edit|exam-delete', ['only' => ['index','show']]);
         $this->middleware('permission:exam-create', ['only' => ['create','store']]);
         $this->middleware('permission:exam-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:exam-delete', ['only' => ['destroy']]);
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
        $exams = Exam::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.exam.index' ,compact('exams'));
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

        $classData = Classname::where('user_id', $userId)->get();
        return view('backend.exam.create',compact('classData'));
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
            'exam_name'=> 'required',
            'exam_date'=> 'required',
            'class_id'=> 'required',
            'section_id'=> 'required',
            'subject_id'=> 'required',
            'total_mark'=> 'required',
            'pass_mark'=> 'required',
        ]);

        $data = $request->all();

        $date = $request->exam_date;
        $examDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $data['exam_date'] = $examDate;

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        //To json encoded...
        $sectionId = json_encode($request->section_id);
        $data['section_id'] = $sectionId;

        if(Exam::create($data)){
            Toastr::success('Successfully Exam Added.', 'Success', ["progressbar" => true]);
           return redirect(route('exam.index'))->with('message','Successfully Exam Added');
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
        //To get current user...
        $userId = CurrentUser::getUserId();

        $exam = Exam::find($id);
        $classData = Classname::where('user_id',$userId)->get();

        //To get all the section data with classId...
        $sectionData = Section::getAllTheSectionDataWithClassId($exam->class_id);
        $subjectData = Subject::getAllTheSubjectDataWithClassId($exam->class_id);

        $singleDate = Carbon::createFromFormat('Y-m-d', $exam->exam_date)->format('d/m/Y');
        return view('backend.exam.edit' , compact('exam','classData','sectionData','subjectData','singleDate'));
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
            'exam_name'=> 'required',
            'exam_date'=> 'required',
            'class_id'=> 'required',
            'section_id'=> 'required',
            'subject_id'=> 'required',
            'total_mark'=> 'required',
            'pass_mark'=> 'required',
        ]);

        $data = $request->all();

        $date = $request->exam_date;
        $examDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        $data['exam_date'] = $examDate;

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        //To json encoded...
        $sectionId = json_encode($request->section_id);
        $data['section_id'] = $sectionId;

        $exam = Exam::find($id);
        if($exam->update($data)){
            Toastr::success('Exam Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('exam.index'))->with('message','Successfully Expense Updated');
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
        $exam = Exam::where('id',$id)->first();

        if($exam->delete()){
            Toastr::success('Exam Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('exam.index'))->with('message','Successfully Exam Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }     
    }


    //To get exam result page...
    public function examResult($id)
    {
        //To get single exam data...
        $examData = Exam::where('id', $id)->first();

        //To get all the section data...
        $allSectionId = json_decode($examData->section_id);
        $publishedResultSectionId = Result::where('exam_id', $examData->id)->where('class_id', $examData->class_id)
                                    ->select('section_id')->groupBy('section_id')->pluck('section_id');
        
        $sectionData = Section::where('class_id', $examData->class_id)->whereIn('id', $allSectionId)
                        ->whereNotIn('id', $publishedResultSectionId)
                        ->get();

        return view('backend.exam.getResultPage' , compact('examData','sectionData'));
    }

    //To get all the student with class & section...
    public function getStudentWithClassSection(Request $request)
    {
        //To get single exam data...
        $examData = Exam::where('id', $request->exam_id)->first();
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();

        //To get all the student...
        $studentData = Student::where('class_id',$request->class_id)
                        ->where('section_id',$request->section_id)->where('session_year', $defaultSessionYear)->get();

        return view('backend.exam.result' , compact('examData','studentData'));
    }

    //To save result data...
    public function resultsStore(Request $request)
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        if(isset($request->student_id)){
        
            foreach ($request->student_id as $key=>$value) {

                $studentData = Student::where('id',$value)->first();

                    $data = new Result();

                    $data['user_id'] = $userId;
                    $data['exam_id'] = $request->exam_id;
                    $data['class_id'] = $studentData->class_id;
                    $data['section_id'] = $studentData->section_id;
                    $data['student_id'] = $value;
                    $data['marks'] = $request->marks[$value];

                    $data->save();
            }

            //To check result is published or not all the sections of this class exam...
            $examData = Exam::where('id', $request->exam_id)->first();
            $allSectionId = json_decode($examData->section_id);
            $publishedResultSectionId = Result::where('exam_id', $request->exam_id)->where('class_id', $studentData->class_id)
                                        ->select('section_id')->groupBy('section_id')->pluck('section_id');

            //To check section ids number...
            if(count($allSectionId) == $publishedResultSectionId->count()){
                Exam::where('id', $request->exam_id)->update(['status' => true]);
            }
        }


        Toastr::success('Result Created Successfully!.', '', ["progressbar" => true]);
        return redirect()->route('exam.index');
    }

    

}
