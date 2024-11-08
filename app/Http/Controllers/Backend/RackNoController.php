<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\RackNo;
use App\Helpers\CurrentUser;

class RackNoController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:library-rack-list|library-rack-create|library-rack-edit|library-rack-delete', ['only' => ['index','show']]);
         $this->middleware('permission:library-rack-create', ['only' => ['create','store']]);
         $this->middleware('permission:library-rack-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:library-rack-delete', ['only' => ['destroy']]);
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
        $rackNoData = RackNo::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.rackNo.index' ,compact('rackNoData'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.rackNo.create');
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
            'rack_no'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(RackNo::create($data)){
            Toastr::success('Rack No Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('rackNo.index'));
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
        $rackNo = RackNo::find($id);
        return view('backend.rackNo.edit' , compact('rackNo'));
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
            'rack_no'=> 'required',
        ]);

        $data = $request->all();

        $rackNo = RackNo::find($id);
        if($rackNo->update($data)){
            Toastr::success('Rack No Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('rackNo.index'))->with('message','Successfully Rack No Updated');
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
        $rackNo = RackNo::find($id);

        if($rackNo->delete()){
            Toastr::success('Rack No Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('rackNo.index'))->with('message','Successfully Rack No Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }

}
