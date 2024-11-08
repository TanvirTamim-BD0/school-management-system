<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Classname;
use App\Helpers\CurrentUser;

class ClassController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:class-list|class-create|class-edit|class-delete', ['only' => ['index','show']]);
         $this->middleware('permission:class-create', ['only' => ['create','store']]);
         $this->middleware('permission:class-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:class-delete', ['only' => ['destroy']]);
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
        $classes = Classname::orderBy('id', 'desc')->where('user_id', $userId)->get();

        return view('backend.class.index' ,compact('classes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.class.create');
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
            'class_name'=> 'required',
        ]);

        $data = $request->all();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;

        if(Classname::create($data)){
            Toastr::success('Class Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('class.index'));
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
        $class = Classname::find($id);
        return view('backend.class.edit' , compact('class'));
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
            'class_name'=> 'required',
        ]);

        $data = $request->all();

        $class = Classname::find($id);
        if($class->update($data)){
            Toastr::success('Class Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('class.index'));
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
        $class = Classname::find($id);

        if($class->delete()){
            Toastr::success('Class Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('class.index'))->with('message','Successfully Class Deleted');
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }
            
    }

}
