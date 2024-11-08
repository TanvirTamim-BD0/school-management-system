<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicExamResult extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'class_id',
        'section_id',
        'exam_id',
        'student_id',
        'marks',
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

    public function examData()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function studentData()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
}
