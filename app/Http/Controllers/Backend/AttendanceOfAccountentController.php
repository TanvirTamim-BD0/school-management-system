<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Accountent;
use App\Models\AccountentAttendance;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class AttendanceOfAccountentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:attendace-of-accountent-list|attendace-of-accountent-create|attendace-of-accountent-edit|attendace-of-accountent-delete', ['only' => ['index','show']]);
         $this->middleware('permission:attendace-of-accountent-create', ['only' => ['create','store']]);
         $this->middleware('permission:attendace-of-accountent-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:attendace-of-accountent-delete', ['only' => ['destroy']]);
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

        //To get all accountent data with userId...
        $accountentData = Accountent::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.attendance.accountentAttendance.index', compact('accountentData'));
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

        return view('backend.attendance.accountentAttendance.create', compact('todayDate'));
    }

    //To get accountent filter data...
    public function getAccountentFilterDataForAttendance(Request $request)
    {
        $selectedDate = $request->date;

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get today date & format of selected date...
        $todayDate = Carbon::now()->today()->toDateString();
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $selectedDate)->format('Y-m-d');

        //To check selected date with today date...
        if($selectedFormatDate <= $todayDate){
            //To check accountentAttendance is available or not with date....
            $data = AccountentAttendance::where('date', $selectedFormatDate)->where('user_id', $userId)->first();

            //To get all the accountentAttendance data...
            $accountentAttendanceData = AccountentAttendance::where('date', $selectedFormatDate)->where('user_id', $userId)->get();

            if(isset($data) && $data != null){
                //To get all the accountent data with userId...
                $accountentData = $accountentAttendanceData;

                return view('backend.attendance.accountentAttendance.filterAccountentDataForAttendanceUpdate', compact('accountentData','data','selectedDate'));
            }else{
                //To get all the accountent data with userId...
                $accountentData = Accountent::orderBy('id', 'desc')->where('user_id', $userId)->get();

                return view('backend.attendance.accountentAttendance.filterAccountentDataForAttendance', compact('accountentData','selectedDate'));
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
            'accountent_id' => 'required',
            'date' => 'required'
        ]);

        //To get today date...
        $todayDate = Carbon::now()->today()->toDateString();

        //To check accountent is avaiable or not...
        if(isset($request->accountent_id)){
            foreach ($request->accountent_id as $key => $value){
                $data = new AccountentAttendance();
                //To get current user...
                $userId = CurrentUser::getUserId();
                $data['user_id'] = $userId;
                $data['accountent_id'] = $value;

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

            Toastr::success('Accountent Attendance Created Successfully.', '', ["progressbar" => true]);
            return redirect()->route('attendace-of-accountent.index');
        }else{
            Toastr::error('You have no accountent data.!', '', ["progressbar" => true]);
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
            'accountent_id' => 'required',
            'date' => 'required'
        ]);

        //To get userId....
        $data = AccountentAttendance::where('id', $id)->first();
        $userId = $data->user_id;

        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        if(isset($request->accountent_id)){
            foreach ($request->accountent_id as $key => $value) {

                $data = AccountentAttendance::where('date', $selectedFormatDate)->where('accountent_id',$value)->where('user_id', $userId)->first();

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

        Toastr::success('Accountent Attendance Update Successfully!.');
        return redirect()->route('attendace-of-accountent.index');
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

    //To get accountent filter data...
    public function getAccountentFilterData(Request $request)
    {
        $classId = $request->class_id;
        $sectionId = $request->section_id;

        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the class & accountent data with userId...
        $classData = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();
        $sectionData = Section::where('user_id', $userId)->where('class_id', $classId)->get();
        $AccountentData = Accountent::orderBy('id', 'desc')->where('user_id', $userId)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->get();

        return view('backend.attendance.accountentAttendace.filterAccountentData', compact('classData','sectionData','accountentData','classId','sectionId'));
    }
}
