<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionForm extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'admission_id',
        'class_id',
        'section_id',
        'group_id',
        'student_name',
        'student_email',
        'student_phone',
        'gender',
        'blood_group',
        'religion',
        'address',
        'date_of_birth',
        'addmission_date',
        'registration_no',
        'roll_no',
        'student_photo',
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

}
