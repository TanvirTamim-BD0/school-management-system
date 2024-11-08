<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Librarian;
use App\Models\LibrarianAttendance;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class AttendanceOfLibrarianController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:attendace-of-librarian-list|attendace-of-librarian-create|attendace-of-librarian-edit|attendace-of-librarian-delete', ['only' => ['index','show']]);
         $this->middleware('permission:attendace-of-librarian-create', ['only' => ['create','store']]);
         $this->middleware('permission:attendace-of-librarian-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:attendace-of-librarian-delete', ['only' => ['destroy']]);
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

        //To get all librarian data with userId...
        $librarianData = Librarian::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.attendance.librarianAttendance.index', compact('librarianData'));
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

        return view('backend.attendance.librarianAttendance.create', compact('todayDate'));
    }

    //To get librarian filter data...
    public function getLibrarianFilterDataForAttendance(Request $request)
    {
        $selectedDate = $request->date;

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get today date & format of selected date...
        $todayDate = Carbon::now()->today()->toDateString();
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $selectedDate)->format('Y-m-d');

        //To check selected date with today date...
        if($selectedFormatDate <= $todayDate){
            //To check librarianAttendance is available or not with date....
            $data = LibrarianAttendance::where('date', $selectedFormatDate)->where('user_id', $userId)->first();

            //To get all the librarianAttendance data...
            $librarianAttendanceData = LibrarianAttendance::where('date', $selectedFormatDate)->where('user_id', $userId)->get();

            if(isset($data) && $data != null){
                //To get all the librarian data with userId...
                $librarianData = $librarianAttendanceData;

                return view('backend.attendance.librarianAttendance.filterLibrarianDataForAttendanceUpdate', compact('librarianData','data','selectedDate'));
            }else{
                //To get all the librarian data with userId...
                $librarianData = librarian::orderBy('id', 'desc')->where('user_id', $userId)->get();

                return view('backend.attendance.librarianAttendance.filterLibrarianDataForAttendance', compact('librarianData','selectedDate'));
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
            'librarian_id' => 'required',
            'date' => 'required'
        ]);

        //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();

        //To check librarian is avaiable or not...
        if(isset($request->librarian_id)){
            foreach ($request->librarian_id as $key => $value){
                $data = new LibrarianAttendance();
                //To get current user...
                $userId = CurrentUser::getUserId();
                $data['user_id'] = $userId;
                $data['librarian_id'] = $value;

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

            Toastr::success('Librarian Attendance Created Successfully.', '', ["progressbar" => true]);
            return redirect()->route('attendace-of-librarian.index');
        }else{
            Toastr::error('You have no librarian data.!', '', ["progressbar" => true]);
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
            'librarian_id' => 'required',
            'date' => 'required'
        ]);

        //To get userId....
        $data = LibrarianAttendance::where('id', $id)->first();
        $userId = $data->user_id;

        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        if(isset($request->librarian_id)){
            foreach ($request->librarian_id as $key => $value) {

                $data = LibrarianAttendance::where('date', $selectedFormatDate)->where('librarian_id',$value)->where('user_id', $userId)->first();

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

        Toastr::success('Librarian Attendance Update Successfully!.');
        return redirect()->route('attendace-of-librarian.index');
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

    //To get librarian filter data...
    public function getLibrarianFilterData(Request $request)
    {
        $classId = $request->class_id;
        $sectionId = $request->section_id;

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class & librarian data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $sectionData = Section::where('user_id', $userId)->where('class_id', $classId)->get();
        $librarianData = Librarian::orderBy('id', 'desc')->where('user_id', $userId)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->get();

        return view('backend.attendance.librarianAttendace.filterLibrarianData', compact('classData','sectionData','librarianData','classId','sectionId'));
    }
}
