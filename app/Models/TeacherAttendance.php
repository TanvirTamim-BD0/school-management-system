<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_id',
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
    
    public function teacherData()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }


    //To fetch all the present data with month...
    public static function presentDataWithMonth($month,$teacherId)
    {
        $presentData = TeacherAttendance::where('month', $month)->where('teacher_id', $teacherId)
                        ->where('present', 1)->count();
        return $presentData;
    }


    //To fetch all the absence data with month...
    public static function absenceDataWithMonth($month,$teacherId)
    {
        $absenceData = TeacherAttendance::where('month', $month)->where('teacher_id', $teacherId)
                        ->where('absence', 1)->count();
        return $absenceData;
    }
    
    //To fetch all the late data with month...
    public static function lateDataWithMonth($month,$teacherId)
    {
        $lateData = TeacherAttendance::where('month', $month)->where('teacher_id', $teacherId)
                        ->where('late', 1)->count();
        return $lateData;
    }
    
    //To fetch all the leave data with month...
    public static function leaveDataWithMonth($month,$teacherId)
    {
        $leaveData = TeacherAttendance::where('month', $month)->where('teacher_id', $teacherId)
                        ->where('leave', 1)->count();
        return $leaveData;
    }


    //To fetch all the attendance with month...
    public static function teacherAttendance($teacherId, $date)
    {
        $attendanceHistory = TeacherAttendance::where('teacher_id', $teacherId)->where('date', $date)->first();
        return $attendanceHistory;
    }

}
