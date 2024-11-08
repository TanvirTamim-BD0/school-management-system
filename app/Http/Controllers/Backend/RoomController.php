<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Auth;
use App\Helpers\CurrentUser;
use Brian2694\Toastr\Facades\Toastr;

class RoomController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:room-list|room-create|room-edit|room-delete', ['only' => ['index','show']]);
         $this->middleware('permission:room-create', ['only' => ['create','store']]);
         $this->middleware('permission:room-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:room-delete', ['only' => ['destroy']]);
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

        $rooms = Room::orderBy('id', 'desc')->where('user_id', $userId)->get();
        return view('backend.room.index' ,compact('rooms'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.room.create');
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
            'room_no'=> 'required',
        ]);

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if(Room::create($data)){
            Toastr::success('Room Created Successfully.', 'Success', ["progressbar" => true]);
           return redirect(route('room.index'))->with('message','Successfully Room Added');
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
        $room = Room::find($id);
        return view('backend.room.edit' , compact('room'));
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
            'room_no'=> 'required',
        ]);

        $data = $request->all();

        $room = Room::find($id);
        if($room->update($data)){
            Toastr::success('Room Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('room.index'))->with('message','Successfully Room Updated');
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
        $room = Room::find($id);

        if($room->delete()){
            Toastr::success('Room Delete Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('room.index'))->with('message','Successfully Room Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
            
    }

}
