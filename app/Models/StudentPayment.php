<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_id',
        'class_id',
        'section_id',
        'student_id',
        'student_fees_assign_id',
        'total_fees_amount',
        'total_fine_amount',
        'total_paid_amount',
        'payment_date',
        'payment_month',
        'year',
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
}
