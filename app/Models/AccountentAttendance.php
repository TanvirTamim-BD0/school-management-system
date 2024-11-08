<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountentAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accountent_id',
        'present',
        'absence',
        'late',
        'leave',
        'date',
        'month',
        'year'
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function accountentData()
    {
        return $this->belongsTo(Accountent::class, 'accountent_id');
    }


    //To fetch all the present data with month...
    public static function presentDataWithMonth($month,$accountentId)
    {
        $presentData = AccountentAttendance::where('month', $month)->where('accountent_id', $accountentId)
                        ->where('present', 1)->count();
        return $presentData;
    }


    //To fetch all the absence data with month...
    public static function absenceDataWithMonth($month,$accountentId)
    {
        $absenceData = AccountentAttendance::where('month', $month)->where('accountent_id', $accountentId)
                        ->where('absence', 1)->count();
        return $absenceData;
    }
    
    //To fetch all the late data with month...
    public static function lateDataWithMonth($month,$accountentId)
    {
        $lateData = AccountentAttendance::where('month', $month)->where('accountent_id', $accountentId)
                        ->where('late', 1)->count();
        return $lateData;
    }
    
    //To fetch all the leave data with month...
    public static function leaveDataWithMonth($month,$accountentId)
    {
        $leaveData = AccountentAttendance::where('month', $month)->where('accountent_id', $accountentId)
                        ->where('leave', 1)->count();
        return $leaveData;
    }


    //To fetch all the attendance with month...
    public static function accountentAttendance($accountentId, $date)
    {
        $attendanceHistory = AccountentAttendance::where('accountent_id', $accountentId)->where('date', $date)->first();
        return $attendanceHistory;
    }
}
