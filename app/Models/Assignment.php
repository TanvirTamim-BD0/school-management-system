<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'section_id',
        'subject_id',
        'title',
        'description',
        'solid_description',
        'deadline',
        'assignment_file',
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
   
    public function sectionData()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    
    public function subjectData()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    //To get all the section data with assignmentsId wise...
    public static function getAllSectionDataWithAssignmentIdWise($assignmentId)
    {
        $data = Assignment::where('id', $assignmentId)->first();
        $sectionIds = json_decode($data->section_id);

        $getSectionData = [];
        foreach($sectionIds as $key => $item){
            if($item != null){
                $getSectionData[] = Section::where('id', $item)->first();
            }
        }

        return $getSectionData;

    }
}
