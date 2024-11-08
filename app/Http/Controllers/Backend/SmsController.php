<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\SendNotification;
use App\Helpers\CurrentUser;
use Carbon\Carbon;
use App\Models\Mail;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;
use App\Http\Controllers\Backend\SendSMSController;

class SmsController extends Controller
{   

    function __construct()
    {
         $this->middleware('permission:sms-list', ['only' => ['index','show']]);
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
        $notificationData = SendNotification::orderBy('id', 'desc')->where('user_id', $userId)
        ->where('is_mobile_sms', true)->get();

        return view('backend.sms.index' ,compact('notificationData'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //To get all the admission data...
        if(Auth::user()->role == 'superadmin'){
            $roleData = Role::get();
        }elseif(Auth::user()->role == 'admin'){
            $roleData = Role::whereNotIn('name', ['superadmin'])->get();
        }elseif(Auth::user()->role == 'teacher'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin'])->get();
        }elseif(Auth::user()->role == 'student'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','teacher'])->get();
        }elseif(Auth::user()->role == 'guardian'){
            $roleData = Role::whereNotIn('name', ['superadmin','admin','teacher','student'])->get();
        }

        return view('backend.sms.create',compact('roleData'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        
       $toAccountIds = $request->to_account_id;

        foreach($toAccountIds as $toAccountId){

            $getUserData = User::where('id',$toAccountId)->first();

            $mobile = $getUserData->mobile;
            $message = $request->description;

            SendSMSController::sendSMS($mobile,$message);
            
            $data['user_id'] = Auth::user()->id;
            $data['role_id'] = $request->role_id;
            $data['to_account_id'] = $toAccountId;
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['status'] = 1;
            $data['is_mobile_sms'] = 1;
            SendNotification::create($data); 
            
        }

        Toastr::success('Successfully SMS Send.', 'Success', ["progressbar" => true]);
        return redirect(route('sms.index'))->with('message','Successfully Message Send');
    }



     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sendNotification = SendNotification::find($id);

        if($sendNotification->delete()){
            Toastr::success('SMS Deleted Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('mail.index'));
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
            
    }
}
