<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Session;
use App\Helpers\CurrentUser;
class SessionController extends Controller
{
    
     /*function __construct()
    {
         $this->middleware('permission:session-list|session-create|session-edit|session-delete', ['only' => ['index','show']]);
         $this->middleware('permission:session-create', ['only' => ['create','store']]);
         $this->middleware('permission:session-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:session-delete', ['only' => ['destroy']]);
    }*/
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the Session data...
        $sessionData = Session::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.session.index' ,compact('sessionData'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.session.create');
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
            'session_name'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(Session::create($data)){
            Toastr::success('Session Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('session.index'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
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
        $session = Session::find($id);
        return view('backend.session.edit' , compact('session'));
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
            'session_name'=> 'required',
        ]);

        $data = $request->all();

        $session = Session::find($id);
        if($session->update($data)){
            Toastr::success('Session Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('session.index'))->with('message','Successfully Session Updated');
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
        $session = Session::find($id);

        if($session->delete()){
            Toastr::success('Session Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('session.index'))->with('message','Successfully Session Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }


}
