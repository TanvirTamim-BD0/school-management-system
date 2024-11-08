<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'title',
        'description',
        'solid_description',
        'syllabus_file',
        'is_demo',
    ];
    
    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classData()
    {
        return $this->belongsTo(Classname::class, 'class_id');
    }
}
