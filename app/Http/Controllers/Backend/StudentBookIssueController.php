<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LibraryBook;
use App\Models\StudentBookIssue;
use App\Models\Student;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use App\Models\StudentLibraryFine;
use App\Models\Contact;
use App\Helpers\DefaultSessionYear;
use Auth;
use App\Models\BookLimitSetting;

class StudentBookIssueController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:student-book-issue-list|student-book-issue-create|student-book-issue-edit|student-book-issue-delete', ['only' => ['index','show']]);
         $this->middleware('permission:student-book-issue-create', ['only' => ['create','store']]);
         $this->middleware('permission:student-book-issue-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:student-book-issue-delete', ['only' => ['destroy']]);
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
        $studentBookIssueData = StudentBookIssue::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.bookIssue.index' ,compact('studentBookIssueData'));
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
        $defaultSessionYear = DefaultSessionYear::getDefaultSessionYear();

        $studentData = Student::where('user_id', $userId)->where('session_year', $defaultSessionYear)->get();
        return view('backend.bookIssue.create',compact('studentData'));
    }


    //student search ......
    public function searchStudent(Request $request){

        //To get current user...
        $userId = CurrentUser::getUserId();

        $student = Student::where('id',$request->student_id)->first();
        $libraryBookData = LibraryBook::where('user_id', $userId)->get();
        $studentBookIssueData = StudentBookIssue::where('student_id',$request->student_id)->get();

        return view('backend.bookIssue.studentDetails',compact('student','studentBookIssueData','libraryBookData'));

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
            'student_id'=> 'required',
            'library_book_id'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
        ]);

        $limitSetting = BookLimitSetting::where('role','student')->first();
        $countIssue = StudentBookIssue::where('student_id',$request->student_id)->count();

        //To check student book issued limit...
        if(isset($limitSetting) && $limitSetting != null){
            if ($limitSetting->number > $countIssue) {
                
                $check = StudentBookIssue::where('student_id',$request->student_id)->where('library_book_id',$request->library_book_id)->where('status',0)->first();

                if (isset($check) && $check != null) {
                
                    Toastr::error('Book All Ready Issue !.', 'Error', ["progressbar" => true]);
                    return redirect(route('bookIssue.create'));
                }else{
                    
                    $libraryBook = LibraryBook::where('id',$request->library_book_id)->first();
                    $libraryBook->quantity -= 1;
                    $libraryBook->save();

                    $data = $request->all();

                    //To get current user...
                    $userId = CurrentUser::getUserId();
                    $data['user_id'] = $userId;

                    $start = $request->start_date;
                    $end = $request->end_date;

                    $startDate = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');
                    $data['start_date'] = $startDate;

                    $endDate = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
                    $data['end_date'] = $endDate;

                    if(StudentBookIssue::create($data)){
                        Toastr::success('Successfully Book Issue.', 'Success', ["progressbar" => true]);
                    return redirect(route('bookIssue.create'));
                    }else{
                        Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
                        return redirect(route('bookIssue.create'));
                    }

                }
            }else{
                Toastr::error('This student library book limit over!.', 'Error', ["progressbar" => true]);
                return redirect(route('bookIssue.create'));
            }
        }else{
            Toastr::error('First set student library book limit.!', 'Error', ["progressbar" => true]);
            return redirect(route('book-limit-setting.create'));
        }
        
    }


    //student book issue update..........
    public function bookIssueUpdate(Request $request,$id){

        $request->validate([
            'library_book'=> 'required',
            'start_date_1'=> 'required',
            'end_date_1'=> 'required',
        ]);

        $start = $request->start_date_1;
        $startDate = Carbon::createFromFormat('d/m/Y', $start)->format('Y-m-d');

        $end = $request->end_date_1;
        $endDate = Carbon::createFromFormat('d/m/Y', $end)->format('Y-m-d');
        
        $studentBookIssue = StudentBookIssue::find($id);
        $studentBookIssue->library_book_id = $request->library_book;
        $studentBookIssue->start_date = $startDate;
        $studentBookIssue->end_date = $endDate;
        $studentBookIssue->note = $request->note_1;
        $studentBookIssue->save();
    
        Toastr::success('Successfully Book Issue Updated.', 'Success', ["progressbar" => true]);
           return redirect(route('bookIssue.create'));
    }


    //return book ...
    public function bookReturn($id){

        $todayDate = Carbon::now()->today()->toDateString();
        $bookIsuue = StudentBookIssue::where('id',$id)->first();
        if ($bookIsuue->status == 0) {

            if ($todayDate < $bookIsuue->end_date) {

                $bookIsuue->status = 1;
                $bookIsuue->save();

                $libraryBook = LibraryBook::where('id',$bookIsuue->library_book_id)->first();
                $libraryBook->quantity += 1;
                $libraryBook->save();

                Toastr::success('Successfully Book Return.', 'Success', ["progressbar" => true]);
                return redirect(route('bookIssue.index'));

            }else{
                return view('backend.bookIssue.returnFine',compact('bookIsuue'));
            }

        }else{
              return redirect()->back()->with('error','Error !! Added Failed');
        }

    }


    //library book return date expire fine ...........
    public function libraryBookFine(Request $request){

            //To get current user...
            $userId = CurrentUser::getUserId();

            $invoiceNumber = "INV-TP-".random_int(100000, 999999);
            $todayDate = Carbon::now()->today()->toDateString();

            $libraryFine = new StudentLibraryFine();
            $libraryFine->user_id = $userId;
            $libraryFine->invoice_id = $invoiceNumber;
            $libraryFine->student_id = $request->student_id;
            $libraryFine->library_book_id = $request->library_book_id;
            $libraryFine->fine_amount = $request->fine_amount;
            $libraryFine->payment_date = $todayDate;
            $libraryFine->save();

            $bookIsuue = StudentBookIssue::where('student_id',$request->student_id)->where('library_book_id',$request->library_book_id)->first();
            $bookIsuue->status = 1;
            $bookIsuue->save();

            $libraryBook = LibraryBook::where('id',$request->library_book_id)->first();
            $libraryBook->quantity += 1;
            $libraryBook->save();

            
             //To get today date...
            $todayDate = Carbon::now()->today()->toDateString();
            $singleStudentData = Student::where('id', $request->student_id)->first();            
            $singleContactInfoData = Contact::first();

            // dd($singleContactInfoData->logo_img);
            //To generate array-data for print-invoice-page...
            $invoiceData = array(
                'school_logo' => $singleContactInfoData->logo_image,
                'name' => $singleContactInfoData->name,
                'email' => $singleContactInfoData->email,
                'phone' => $singleContactInfoData->phone,
                'address' => $singleContactInfoData->address,
                'date' => $todayDate,
                'student_name' => $singleStudentData->student_name,
                'student_email' => $singleStudentData->student_email,
                'student_phone' => $singleStudentData->student_phone,
                'address' => $singleStudentData->address,
                'payment_date' => $todayDate,
                'payment_amount' => $request->fine_amount,
            );

            return view('backend.bookIssue.fineInvoice', compact('invoiceData'));

    }


    //To get student date expire book issued list...... 
    public function studentDateExpireIssuedList()
    {
        //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data...
        $expireIssuedData = StudentBookIssue::orderBy('id', 'desc')->where('user_id', $userId)->where('status', false)
                            ->where('end_date', '<', $todayDate)->get();

        return view('backend.bookIssue.studentDateExpireIssuedList' ,compact('expireIssuedData'));
    }  
    
    //return date expire book fine list...... 
    public function returnDateExpireFineList(){

         //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class data...
        $fineList = StudentLibraryFine::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.bookIssue.returnBookFineList' ,compact('fineList'));
    }  


    //fine amount invoice ...........
    public function fineAmountInvoice($id){
        
        $data = StudentLibraryFine::where('id',$id)->first();
        
         //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();
        $singleStudentData = Student::where('id', $data->student_id)->first();            
        $singleContactInfoData = Contact::first();


        $invoiceData = array(
                'school_logo' => $singleContactInfoData->logo_image,
                'name' => $singleContactInfoData->name,
                'email' => $singleContactInfoData->email,
                'phone' => $singleContactInfoData->phone,
                'address' => $singleContactInfoData->address,
                'date' => $todayDate,
                'student_name' => $singleStudentData->student_name,
                'student_email' => $singleStudentData->student_email,
                'student_phone' => $singleStudentData->student_phone,
                'address' => $singleStudentData->address,
                'payment_date' => $data->payment_date,
                'payment_amount' => $data->fine_amount,
            );

            return view('backend.bookIssue.fineInvoice', compact('invoiceData'));


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $studentBookIssue = StudentBookIssue::find($id);

        if($studentBookIssue->delete()){
            Toastr::success('Book Issue Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('bookIssue.index'))->with('message','Successfully Book Issue Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }



}
