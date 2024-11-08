<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Notice;
use App\Helpers\CurrentUser;
use Carbon\Carbon;

class NoticeController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:notice-list|notice-create|notice-edit|notice-delete', ['only' => ['index','show']]);
         $this->middleware('permission:notice-create', ['only' => ['create','store']]);
         $this->middleware('permission:notice-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:notice-delete', ['only' => ['destroy']]);
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
        $noticeData = Notice::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.notice.index' ,compact('noticeData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.notice.create');
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
            'date'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        
        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $data['date'] = $selectedFormatDate;

        if(Notice::create($data)){
            Toastr::success('Notice Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('notice.index'));
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
        $singleNoticeData = Notice::find($id);
        $singleNoticeDate = Carbon::createFromFormat('Y-m-d', $singleNoticeData->date)->format('d/m/Y');
        return view('backend.notice.edit' , compact('singleNoticeData','singleNoticeDate'));
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
            'date'=> 'required',
        ]);

        $data = $request->all();
        $singleNoticeData = Notice::find($id);

        //To formate of selected date...
        $selectedFormatDate = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $data['date'] = $selectedFormatDate;

        if($singleNoticeData->update($data)){
            Toastr::success('Notice Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('notice.index'));
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
        $singleNoticeData = Notice::find($id);

        if($singleNoticeData->delete()){
            Toastr::success('Notice Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('notice.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
    }
}
