<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class SendSMSController extends Controller
{
        /**
    * Send Sms
    * @param $contact
    * @param $text
    */
    public static function sendSMS($contact,$text){

    	$url = "https://isms.mimsms.com/smsapi";
		$data = [
		    "api_key" => "C20018216388a9114c7376.61721955",
		    "type" => "text",
		    "contacts" => $contact,
		    "senderid" => "8809601004746",
		    "msg" => $text,
		 ];
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_URL, $url);
		 curl_setopt($ch, CURLOPT_POST, 1);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 $response = curl_exec($ch);
		 curl_close($ch);
		 return $response;
        
    }

}
