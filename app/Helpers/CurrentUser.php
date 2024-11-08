<?php
namespace App\Helpers;
use App\Models\User;
use Auth;

class CurrentUser{

    public static function getUserId()
    {
        if(Auth::user()->role == 'superadmin'){
            $userId = Auth::user()->id;
        }elseif(Auth::user()->role == 'admin'){
            $userId = Auth::user()->id;
        }elseif(Auth::user()->role == 'teacher'){
            $userId = Auth::user()->admin_id;
        }elseif(Auth::user()->role == 'accountent'){
            $userId = Auth::user()->admin_id;
        }elseif(Auth::user()->role == 'librarian'){
            $userId = Auth::user()->admin_id;
        }elseif(Auth::user()->role == 'student'){
            $userId = Auth::user()->admin_id;
        }elseif(Auth::user()->role == 'guardian'){
            $userId = Auth::user()->admin_id;
        }

        return $userId;
    }

    //To check user is already exist or not...
    public static function checkUserIsExistOrNot($userId, $phone, $email)
    {
        $isExistPhone = self::isExistUserPhone($userId, $phone);
        $isExistEmail = self::isExistUserEmail($userId, $email);

        $arr = [];
        if(isset($isExistPhone) && $isExistPhone != null){
            $arr = array(
                'status' => 1,
                'userData' => $isExistPhone
            );
        }else if(isset($isExistEmail) && $isExistEmail != null){
            $arr = array(
                'status' => 2,
                'userData' => $isExistEmail
            );
        }else{
            $arr = null;
        }

        return $arr;
    }

    //To check user is already exist or not...
    public static function isExistUserPhone($userId, $phone)
    {
        if($phone != null){
            $data = User::where('mobile', $phone)->where('admin_id', $userId)->first();
        }else{
            $data = null;
        }
        
        return $data;
    }
    
    //To check user is already exist or not...
    public static function isExistUserEmail($userId, $email)
    {
        if($email != null){
            $data = User::where('email', $email)->where('admin_id', $userId)->first();
        }else{
            $data = null;
        }
        return $data;
    }


    //To check user is already exist or not...
    public static function checkUserIsExistOrNotForGuardian($userId, $phone, $email)
    {
        $isExistPhoneForGD = self::isExistUserPhoneForGD($userId, $phone);
        $isExistEmailForGD = self::isExistUserEmailForGD($userId, $email);

        $arr = [];
        if(isset($isExistPhoneForGD) && $isExistPhoneForGD != null){
            $arr = array(
                'status' => 1,
                'userData' => $isExistPhoneForGD
            );
        }else if(isset($isExistEmailForGD) && $isExistEmailForGD != null){
            $arr = array(
                'status' => 2,
                'userData' => $isExistEmailForGD
            );
        }else{
            $arr = null;
        }

        return $arr;
    }

    //To check user is already exist or not...
    public static function isExistUserPhoneForGD($userId, $phone)
    {
        if($phone != null){
            $data = User::where('mobile', $phone)->where('admin_id', $userId)->first();
        }else{
            $data = null;
        }
        return $data;
    }
    
    //To check user is already exist or not...
    public static function isExistUserEmailForGD($userId, $email)
    {
        if($email != null){
            $data = User::where('admin_id', $userId)->where('email', $email)->first();
        }else{
            $data = null;
        }
        return $data;
    }
}