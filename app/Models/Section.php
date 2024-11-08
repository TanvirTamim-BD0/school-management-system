<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
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

    //To get single class data...
    public static function getSingleSectionData($sectionId)
    {
        $data = Section::where('id', $sectionId)->first();
        return $data;
    }

    //To get all the section data with classId...
    public static function getAllTheSectionDataWithClassId($classId)
    {
        $data = Section::where('class_id', $classId)->get();
        return $data;
    }
}
