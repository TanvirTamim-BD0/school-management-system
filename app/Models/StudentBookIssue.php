<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBookIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'library_book_id',
        'start_date',
        'end_date',
        'note',
        'status',
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
