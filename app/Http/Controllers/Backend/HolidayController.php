<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Holiday;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class HolidayController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:holiday-list|holiday-create|holiday-edit|holiday-delete', ['only' => ['index','show']]);
         $this->middleware('permission:holiday-create', ['only' => ['create','store']]);
         $this->middleware('permission:holiday-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:holiday-delete', ['only' => ['destroy']]);
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
        $holidayData = Holiday::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.holiday.index' ,compact('holidayData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.holiday.create');
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
            'title'=> 'required',
            'description'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'holiday_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        
        //To formate of selected date...
        $selectedFormatStartDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $selectedFormatEndDate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $data['start_date'] = $selectedFormatStartDate;
        $data['end_date'] = $selectedFormatEndDate;

        //To check file..
        if($request->hasFile('holiday_file')) {
            $file = $request->file('holiday_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/holidayFile'), $fileName);
            $data['holiday_file'] = $fileName;
        }

        if(Holiday::create($data)){
            Toastr::success('Holiday Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('holiday.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
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
        $singleHolidayData = Holiday::find($id);
        $singleHolidayFormatStartDate = Carbon::createFromFormat('Y-m-d', $singleHolidayData->start_date)->format('d/m/Y');
        $singleHolidayFormatEndDate = Carbon::createFromFormat('Y-m-d', $singleHolidayData->end_date)->format('d/m/Y');

        return view('backend.holiday.edit' , compact('singleHolidayData','singleHolidayFormatStartDate','singleHolidayFormatEndDate'));
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
            'title'=> 'required',
            'description'=> 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'holiday_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
        ]);

        $data = $request->all();
        $singleHolidayData = Holiday::find($id);

         //To formate of selected date...
        $selectedFormatStartDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $selectedFormatEndDate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $data['start_date'] = $selectedFormatStartDate;
        $data['end_date'] = $selectedFormatEndDate;

        //To check file..
        if($request->hasFile('holiday_file')) {
            if  (file_exists(public_path('backend/uploads/holidayFile/'.$singleHolidayData->holiday_file))) {
                unlink(public_path('backend/uploads/holidayFile/'.$singleHolidayData->holiday_file));
            }

            $file = $request->file('holiday_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/holidayFile'), $fileName);
            $data['holiday_file'] = $fileName;
        }

        if($singleHolidayData->update($data)){
            Toastr::success('Holiday Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('holiday.index'));
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
        $singleHolidayData = Holiday::find($id);

        // To check holiday file is avaiable or not...
        if ($data->holiday_file != null && file_exists(public_path('backend/uploads/holidayFile/'.$singleHolidayData->holiday_file))) {
            unlink(public_path('backend/uploads/holidayFile/'.$singleHolidayData->holiday_file));
        }

        if($singleHolidayData->delete()){
            Toastr::success('Holiday Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('holiday.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    //To download holiday file...
    public function holidayFileDdownload($holidayId)
    {
        $data = Holiday::where('id', $holidayId)->first();
        if(file_exists(public_path('backend/uploads/holidayFile/'.$data->holiday_file))) {
            $path = public_path('backend/uploads/holidayFile/'.$data->holiday_file);

            $fileName = 'holidayFile.zip';
            return Response::download($path);
        }else{
            Toastr::error('Sorry File Not Exist.!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
        
    }
}
