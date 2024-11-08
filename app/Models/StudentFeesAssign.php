<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeesAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fees_type_id',
        'fees_assign_id',
        'class_id',
        'section_id',
        'student_id',
        'fees_amount',
        'paid_amount',
        'due_amount',
        'change_amount',
        'year',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function feesTypeData()
    {
        return $this->belongsTo(FeesType::class, 'fees_type_id');
    }
    
    public function feesAssignData()
    {
        return $this->belongsTo(FeesAssign::class, 'fees_assign_id');
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
}
