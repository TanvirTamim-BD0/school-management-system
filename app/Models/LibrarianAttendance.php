<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibrarianAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'librarian_id',
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
    
    public function librarianData()
    {
        return $this->belongsTo(Librarian::class, 'librarian_id');
    }


    //To fetch all the present data with month...
    public static function presentDataWithMonth($month,$librarianId)
    {
        $presentData = LibrarianAttendance::where('month', $month)->where('librarian_id', $librarianId)
                        ->where('present', 1)->count();
        return $presentData;
    }


    //To fetch all the absence data with month...
    public static function absenceDataWithMonth($month,$librarianId)
    {
        $absenceData = LibrarianAttendance::where('month', $month)->where('librarian_id', $librarianId)
                        ->where('absence', 1)->count();
        return $absenceData;
    }
    
    //To fetch all the late data with month...
    public static function lateDataWithMonth($month,$librarianId)
    {
        $lateData = LibrarianAttendance::where('month', $month)->where('librarian_id', $librarianId)
                        ->where('late', 1)->count();
        return $lateData;
    }
    
    //To fetch all the leave data with month...
    public static function leaveDataWithMonth($month,$librarianId)
    {
        $leaveData = LibrarianAttendance::where('month', $month)->where('librarian_id', $librarianId)
                        ->where('leave', 1)->count();
        return $leaveData;
    }


    //To fetch all the attendance with month...
    public static function librarianAttendance($librarianId, $date)
    {
        $attendanceHistory = LibrarianAttendance::where('librarian_id', $librarianId)->where('date', $date)->first();
        return $attendanceHistory;
    }
}
