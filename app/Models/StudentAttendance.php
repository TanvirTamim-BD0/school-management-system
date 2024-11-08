<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'section_id',
        'student_id',
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
    
    public function classData()
    {
        return $this->belongsTo(Classname::class, 'class_id');
    }

    public function sectionData()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    
    public function studentData()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    //To fetch all the present data with month...
    public static function presentDataWithMonth($month, $classId, $sectionId, $studentId)
    {
        $presentData = StudentAttendance::where('month', $month)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->where('student_id', $studentId)
                        ->where('present', 1)->count();
        return $presentData;
    }


    //To fetch all the absence data with month...
    public static function absenceDataWithMonth($month, $classId, $sectionId, $studentId)
    {
        $absenceData = StudentAttendance::where('month', $month)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->where('student_id', $studentId)
                        ->where('absence', 1)->count();
        return $absenceData;
    }
    
    //To fetch all the late data with month...
    public static function lateDataWithMonth($month, $classId, $sectionId, $studentId)
    {
        $lateData = StudentAttendance::where('month', $month)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->where('student_id', $studentId)
                        ->where('late', 1)->count();
        return $lateData;
    }
    
    //To fetch all the leave data with month...
    public static function leaveDataWithMonth($month, $classId, $sectionId, $studentId)
    {
        $leaveData = StudentAttendance::where('month', $month)->where('class_id', $classId)
                        ->where('section_id', $sectionId)->where('student_id', $studentId)
                        ->where('leave', 1)->count();
        return $leaveData;
    }


    //To fetch all the attendance with month...
    public static function studentAttendance($classId, $sectionId, $studentId, $date)
    {
        $attendanceHistory = StudentAttendance::where('class_id', $classId)->where('section_id', $sectionId)
                            ->where('student_id', $studentId)->where('date', $date)->first();
        return $attendanceHistory;
    }

}
