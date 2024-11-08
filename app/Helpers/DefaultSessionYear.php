<?php
namespace App\Helpers;
use App\Models\User;
use App\Models\DefaultSession;
use Carbon\Carbon;
use Auth;

class DefaultSessionYear{
    
    //To check default session...
    public static function getDefaultSessionYear()
    {
        //To get current user & session year...
        $userId = CurrentUser::getUserId();

        //To get current year...
        $currentYear = Carbon::now()->year;

        //To fetch single default session data...
        $defaultSessionData = DefaultSession::where('user_id', $userId)->first();

        if(($defaultSessionData) && $defaultSessionData != null){
            return $defaultSessionData->session_year;
        }else{
            $defaultSessionData = $currentYear;
            return $defaultSessionData;
        }
    }

}