<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLibraryFine extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'library_book_id',
        'invoice_id',
        'fine_amount',
        'payment_date',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studentData()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function LibraryBookData()
    {
        return $this->belongsTo(LibraryBook::class, 'library_book_id');
    }

}
