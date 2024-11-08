<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'section_id',
        'subject_id',
        'teacher_id'
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
    
    public function subjectData()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    
    public function teacherData()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
