<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LibraryBook;
use App\Models\TeacherBookIssue;
use App\Models\Teacher;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use App\Models\Contact;
use App\Helpers\DefaultSessionYear;
use App\Models\BookLimitSetting;

class TeacherBookIssueController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:teacher-book-issue-list|teacher-book-issue-create|teacher-book-issue-edit|teacher-book-issue-delete', ['only' => ['index','show']]);
         $this->middleware('permission:teacher-book-issue-create', ['only' => ['create','store']]);
         $this->middleware('permission:teacher-book-issue-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:teacher-book-issue-delete', ['only' => ['destroy']]);
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
        $teacherBookIssueData = TeacherBookIssue::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.teacherbookIssue.index' ,compact('teacherBookIssueData'));
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

        $teacherData = Teacher::where('user_id', $userId)->get();
        return view('backend.teacherbookIssue.create',compact('teacherData'));
    }



    //teacher search ......
    public function searchteacher(Request $request){

        //To get current user...
        $userId = CurrentUser::getUserId();

        $teacher = Teacher::where('id',$request->teacher_id)->first();
        $libraryBookData = LibraryBook::where('user_id', $userId)->get();
        $teacherBookIssueData = TeacherBookIssue::where('teacher_id',$request->teacher_id)->get();

        return view('backend.teacherbookIssue.teacherDetails',compact('teacher','teacherBookIssueData','libraryBookData'));

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
            'teacher_id'=> 'required',
            'library_book_id'=> 'required',
            'issue_date'=> 'required',
            'return_date'=> 'required',
        ]);

        $limitSetting = BookLimitSetting::where('role','teacher')->first();
        $countIssue = TeacherBookIssue::where('teacher_id',$request->teacher_id)->count();

        //To check teacher book issued limit...
        if(isset($limitSetting) && $limitSetting != null){
            if ($limitSetting->number > $countIssue) {

                $check = TeacherBookIssue::where('teacher_id',$request->teacher_id)->where('library_book_id',$request->library_book_id)->where('status',0)->first();

                if (isset($check) && $check != null) {
                    Toastr::error('This book is already issued.!', 'Error', ["progressbar" => true]);
                    return redirect(route('book-issue-teacher.create'));
                }else{

                    $libraryBook = LibraryBook::where('id',$request->library_book_id)->first();
                    $libraryBook->quantity -= 1;
                    $libraryBook->save();

                    $data = $request->all();

                    //To get current user...
                    $userId = CurrentUser::getUserId();
                    $data['user_id'] = $userId;

                    $start = $request->issue_date;
                    $end = $request->return_date;

                    $startDate = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
                    $data['issue_date'] = $startDate;

                    $endDate = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
                    $data['return_date'] = $endDate;

                    if(TeacherBookIssue::create($data)){
                        Toastr::success('Successfully Teacher Book Issue.', 'Success', ["progressbar" => true]);
                    return redirect(route('book-issue-teacher.create'));
                    }else{
                        Toastr::error('Soething is wrong.!', 'Error', ["progressbar" => true]);
                        return redirect(route('book-issue-teacher.create'));
                    }
                }

            }else{
                Toastr::error('This teacher library book limit over.!', 'Error', ["progressbar" => true]);
                return redirect(route('book-issue-teacher.create'));
            }
        }else{
            Toastr::error('First set teacher library book limit.!', 'Error', ["progressbar" => true]);
            return redirect(route('book-limit-setting.create'));
        }
    }


    //return book ...
    public function teacherBookReturn($id){

        $bookIsuue = TeacherBookIssue::where('id',$id)->first();
        if ($bookIsuue->status == 0) {

                $bookIsuue->status = 1;
                $bookIsuue->save();

                $libraryBook = LibraryBook::where('id',$bookIsuue->library_book_id)->first();
                $libraryBook->quantity += 1;
                $libraryBook->save();

                Toastr::success('Successfully Book Return.', 'Success', ["progressbar" => true]);
                return redirect(route('book-issue-teacher.index'));

        }else{
              return redirect()->back()->with('error','Error !! Added Failed');
        }

    }


    //To get teacher date expire book issued list...... 
    public function teacherDateExpireIssuedList()
    {
        //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data...
        $expireIssuedData = TeacherBookIssue::orderBy('id', 'desc')->where('user_id', $userId)->where('status', false)
                            ->where('return_date', '<', $todayDate)->get();

        return view('backend.teacherbookIssue.teacherDateExpireIssuedList' ,compact('expireIssuedData'));
    } 


}
