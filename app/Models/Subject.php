<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'user_id',
        'class_id',
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

    //To get all the subject data with classId...
    public static function getAllTheSubjectDataWithClassId($classId)
    {
        $data = Subject::where('class_id', $classId)->get();
        return $data;
    }
}
