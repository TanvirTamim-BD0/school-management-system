<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Queue;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use Auth;
use Spatie\Permission\Models\Role;

class QueueContoller extends Controller
{
    
    public function index(){
        return view('backend.queue.index');
    }

    public function queueAdd(Request $request){

        $request->validate([
            'queue_text'=> 'required',
        ]);

        $data = $request->all();
        $role = Role::where('name',Auth::user()->role)->first();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        $data['queue_user_id'] = Auth::user()->id;
        $data['role_id'] = $role->id;

        if(Queue::create($data)){
            Toastr::success('Queue Add Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('queue'));
        }else{
            Toastr::error('Soething is wrong!.', 'Error', ["progressbar" => true]);
            return redirect()->back();
        }

    }
}
