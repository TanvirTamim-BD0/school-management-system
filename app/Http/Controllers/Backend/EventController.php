<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Event;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class EventController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index','show']]);
         $this->middleware('permission:event-create', ['only' => ['create','store']]);
         $this->middleware('permission:event-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:event-delete', ['only' => ['destroy']]);
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
        $eventData = Event::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.event.index' ,compact('eventData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.event.create');
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
            'event_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
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
        if($request->hasFile('event_file')) {
            $file = $request->file('event_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/eventFile'), $fileName);
            $data['event_file'] = $fileName;
        }

        if(Event::create($data)){
            Toastr::success('Event Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('event.index'));
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
        $singleEventData = Event::find($id);
        $singleEventFormatStartDate = Carbon::createFromFormat('Y-m-d', $singleEventData->start_date)->format('d/m/Y');
        $singleEventFormatEndDate = Carbon::createFromFormat('Y-m-d', $singleEventData->end_date)->format('d/m/Y');

        return view('backend.event.edit' , compact('singleEventData','singleEventFormatStartDate','singleEventFormatEndDate'));
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
            'event_file'=> 'nullable|mimes:pdf,xml,jpg,jpeg,png,gif,svg,webp',
        ]);

        $data = $request->all();
        $singleEventData = Event::find($id);

         //To formate of selected date...
        $selectedFormatStartDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $selectedFormatEndDate = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $data['start_date'] = $selectedFormatStartDate;
        $data['end_date'] = $selectedFormatEndDate;
        //To check file..
        if($request->hasFile('event_file')) {
            if  (file_exists(public_path('backend/uploads/eventFile/'.$singleEventData->event_file))) {
                unlink(public_path('backend/uploads/eventFile/'.$singleEventData->event_file));
            }

            $file = $request->file('event_file');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/eventFile'), $fileName);
            $data['event_file'] = $fileName;
        }
        
        // dd($data);
        if($singleEventData->update($data)){
            Toastr::success('Event Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('event.index'));
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
        $singleEventData = Event::find($id);

        // To check event file is avaiable or not...
        if  ($singleEventData->event_file != null && file_exists(public_path('backend/uploads/eventFile/'.$singleEventData->event_file))) {
            unlink(public_path('backend/uploads/eventFile/'.$singleEventData->event_file));
        }

        if($singleEventData->delete()){
            Toastr::success('Event Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('event.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    //To download event file...
    public function eventFileDdownload($eventId)
    {
        $data = Event::where('id', $eventId)->first();
        if(file_exists(public_path('backend/uploads/eventFile/'.$data->event_file))) {
            $path = public_path('backend/uploads/eventFile/'.$data->event_file);

            $fileName = 'eventFile.zip';
            return Response::download($path);
        }else{
            Toastr::error('Sorry File Not Exist.!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
        
    }
}
