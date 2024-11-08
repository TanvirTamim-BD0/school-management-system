<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\BookLimitSetting;
use App\Helpers\CurrentUser;
use Spatie\Permission\Models\Role;

class BookLimitSettingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To get current user...
        $userId = CurrentUser::getUserId();

        //To get all the data...
        $data = BookLimitSetting::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.bookLimitSetting.index' ,compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $roles = Role::whereIn('name', ['teacher','student'])->get();
        return view('backend.bookLimitSetting.create',compact('roles'));
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
            'role'=> 'required',
            'number'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(BookLimitSetting::create($data)){
            Toastr::success('Book Limit Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('book-limit-setting.index'));
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
        $bookLimitSetting = BookLimitSetting::find($id);
        $roles = Role::whereIn('name', ['teacher','student'])->get();
        return view('backend.bookLimitSetting.edit' , compact('bookLimitSetting','roles'));
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
            'role'=> 'required',
            'number'=> 'required',
        ]);

        $data = $request->all();

        $bookLimitSetting = BookLimitSetting::find($id);
        if($bookLimitSetting->update($data)){
            Toastr::success('Book Limit Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('book-limit-setting.index'))->with('message','Successfully Book Limit Updated');
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
        $bookLimitSetting = BookLimitSetting::find($id);

        if($bookLimitSetting->delete()){
            Toastr::success('Book Limit Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('book-limit-setting.index'))->with('message','Successfully Book Limit Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }

}
