<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_name',
        'teacher_email',
        'teacher_phone',
        'teacher_category',
        'traning_and_qualification',
        'gender',
        'blood_group',
        'religion',
        'address',
        'joining_date',
        'date_of_birth',
        'salary',
        'designation',
        'teacher_photo',
        'is_demo',
    ];
    
    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //To get teacher details data...
    public static function getSingleTeacherDetailWithEmail($id)
    {
        //To fetch single teacher & user data...
        $singleUserData = User::where('id', $id)->first();
        $singleTeacherData = Teacher::where('teacher_email', $singleUserData->email)->first();

        return $singleTeacherData;
    }

    public static function getSingleTeacher($mobile)
    {
        $data = Teacher::where('teacher_phone', $mobile)->first();
        return $data;
    }
}
