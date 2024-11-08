<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Auth;
use App\Helpers\CurrentUser;
use Brian2694\Toastr\Facades\Toastr;

class GroupController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index','show']]);
         $this->middleware('permission:group-create', ['only' => ['create','store']]);
         $this->middleware('permission:group-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:group-delete', ['only' => ['destroy']]);
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
        
        $groups = Group::orderBy('id', 'desc')->where('user_id', $userId)->get();
        return view('backend.group.index' ,compact('groups'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.group.create');
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
            'group_name'=> 'required',
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if(Group::create($data)){

            Toastr::success('Group Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('group.index'))->with('message','Successfully Group Added');
        }else{
            return redirect()->back()->with('error','Error !! Added Failed');
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
        $group = Group::find($id);
        return view('backend.group.edit' , compact('group'));
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
            'group_name'=> 'required',
        ]);

        $data = $request->all();

        $group = Group::find($id);
        if($group->update($data)){
            Toastr::success('Group Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('group.index'))->with('message','Successfully Group Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
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
        $group = Group::find($id);

        if($group->delete()){
            Toastr::success('Group Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('group.index'))->with('message','Successfully Group Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
            
    }
}
