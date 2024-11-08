<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'section_id',
        'subject_id',
        'exam_name',
        'exam_date',
        'total_mark',
        'pass_mark',
        'status',
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

    //To get all the section data with examId wise...
    public static function getAllSectionDataWithExamIdWise($examId)
    {
        $data = Exam::where('id', $examId)->first();
        $allSectionId = json_decode($data->section_id);

        $getSectionData = [];
        foreach($allSectionId as $key => $item){
            if($item != null){
                $getSectionData[] = Section::where('id', $item)->first();
            }
        }
        
        return $getSectionData;

    }

}
