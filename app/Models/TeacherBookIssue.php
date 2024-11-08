<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherBookIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_id',
        'library_book_id',
        'issue_date',
        'return_date',
        'note',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function TeacherData()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function LibraryBookData()
    {
        return $this->belongsTo(LibraryBook::class, 'library_book_id');
    }

}
