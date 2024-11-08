<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'section_id',
        'student_id',
        'father_name',
        'father_profession',
        'email',
        'phone',
        'mother_name',
        'mother_profession',
        'mother_email',
        'mother_phone',
        'address',
        'photo',
        'is_demo'
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
    
    public function groupData()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

     public function studentData()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    public static function getSingleGurdian($mobile)
    {
        $data = Guardian::where('phone', $mobile)->first();
        return $data;
    }
    
}
