<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use App\Models\PushNotification;
use Carbon\Carbon;
use App\Helpers\CurrentUser;
use Auth;

class PushNotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $time = $currentTime->format('h:i:s');
        $dt = Carbon::now('Asia/Dhaka');
        $currentTime = $dt->hour.':'.$dt->minute;

        // dd($currentTime);

        $data = PushNotification::where('sending_date', '!=', null)->orderBy('id','desc')->paginate(20);
    	return view('backend.pushNotification.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pushNotification.create');
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
            'sending_date' => 'required',
            'sending_time' => 'required',
            'notification_title' => 'required',
            'notification_message' => 'required'
        ]);

        $data = $request->all();
        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        
        //To formate of selected date...
        $selectedFormatSendingDate = Carbon::createFromFormat('d/m/Y', $request->sending_date)->format('Y-m-d');
        $selectedFormatSendingTime = Carbon::createFromFormat('H:i A', $request->sending_time)->format('H:i:s');
        $data['sending_date'] = $selectedFormatSendingDate;
        $data['sending_time'] = $selectedFormatSendingTime;
 
        if(PushNotification::create($data)){
            Toastr::success('Push Notification Created Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('push-notification.index'));
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
        $pushNotification = PushNotification::where('id', $id)->first();
        $sendingDate = Carbon::createFromFormat('Y-m-d', $pushNotification->sending_date)->format('d/m/Y');
        $sendingTime = Carbon::createFromFormat('H:i:s', $pushNotification->sending_time)->format('h:i A');

        return view('backend.pushNotification.edit', compact('pushNotification','sendingDate','sendingTime'));
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
            'notification_title' => 'required',
            'notification_message' => 'required'
        ]);

        $data = $request->all();
        $pushNotification = PushNotification::where('id', $id)->first();

        //To get current user...
        $userId = CurrentUser::getUserId();
        $data['user_id'] = $userId;
        
        //To formate of selected date...
        $selectedFormatSendingDate = Carbon::createFromFormat('d/m/Y', $request->sending_date)->format('Y-m-d');
        $selectedFormatSendingTime = Carbon::createFromFormat('H:i A', $request->sending_time)->format('H:i:s');
        $data['sending_date'] = $selectedFormatSendingDate;
        $data['sending_time'] = $selectedFormatSendingTime;

        if($pushNotification->update($data)){
            Toastr::success('Push Notification Updated Successfully.', 'Success', ["progressbar" => true]);
            return redirect(route('push-notification.index'));
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
        $pushNotification = PushNotification::where('id', $id)->first();
        if($pushNotification->delete()){
            return redirect()->route('push-notification.index');
        }else{
            return redirect()->back();
        }
    }


    public function pushNotificationSend(Request $request, $id)
    {
        //To get single push notification...
        $pushNotification = PushNotification::where('id', $id)->first();

        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        $serverKey = 'AAAAcbRxdOs:APA91bGjVUnfD9AtXHzdUT4aJJE-hnEogDPGbVYrnVk1nvci8aFwzrxzHpeq_EUxqs9VBVt4MaSrFLcsqmNZucO8qUAroy5ynmJg2x9WylJ34jhAmPtB4mjxZP_60pKrJK48sR8xB5KQ'; // ADD SERVER KEY HERE PROVIDED BY FCM
    
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $pushNotification->notification_title,
                "body" => $pushNotification->notification_message,  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
            return response()->json([
                'error' => 'Somethig is wrong.!'
            ]);
        }else{
            //To update push notification ststaus....
            $pushNotification->status = true;
            $pushNotification->save();
            curl_close($ch);
            return redirect()->route('push-notification.index');
        }   
    }



    // Direct Send -----------------------------------

    public function pushNotificationDirect()
    {
        $data = PushNotification::where('sending_date',null)->orderBy('id','desc')->paginate(10);
        return view('backend.directSentNotification.index',compact('data'));
    }

    public function pushNotificationDirectCreate()
    {
        return view('backend.directSentNotification.create');
    }

    public function pushNotificationDirectStore(Request $request){

        $request->validate([
            'notification_title' => 'required',
            'notification_message' => 'required'
        ]);

        $data = $request->all();
        if($data = PushNotification::create($data)){

            $pushNotification = PushNotification::where('id', $data->id)->first();
           
            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();
            $serverKey = 'AAAAcbRxdOs:APA91bGjVUnfD9AtXHzdUT4aJJE-hnEogDPGbVYrnVk1nvci8aFwzrxzHpeq_EUxqs9VBVt4MaSrFLcsqmNZucO8qUAroy5ynmJg2x9WylJ34jhAmPtB4mjxZP_60pKrJK48sR8xB5KQ'; // ADD SERVER KEY HERE PROVIDED BY FCM
        
            $data = [
                "registration_ids" => $FcmToken,
                "notification" => [
                    "title" => $request->notification_title,
                    "body" => $request->notification_message,  
                ]
            ];
            $encodedData = json_encode($data);
        
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];
        
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            // Execute post
            $result = curl_exec($ch);
            
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
                return response()->json([
                    'error' => 'Somethig is wrong.!'
                ]);
            }else{
                //To update push notification ststaus....
                $pushNotification->status = true;
                $pushNotification->save();
                curl_close($ch);
                return redirect()->route('push-notification-direct');
            }   

            }else{
                return redirect()->back();
            }

    }



    public function pushNotificationDirectDelete($id)
    {
        $pushNotification = PushNotification::where('id', $id)->first();
        if($pushNotification->delete()){
            return redirect()->route('push-notification-direct');
        }else{
            return redirect()->back();
        }
    }

}
