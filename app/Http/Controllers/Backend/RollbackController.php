<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classname;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Room;
use App\Models\Syllabus;
use App\Models\Guardian;
use App\Models\Assignment;
use App\Models\ClassRutine;
use Brian2694\Toastr\Facades\Toastr;

class RollbackController extends Controller
{
    public function rollBack(){
        return view('backend.rollBack.index');
    }

    public function rollbackCleanData(){

        $isDemo[] = false;

        $classDelete = Classname::whereIn('is_demo',$isDemo)->delete();
        $sectionDelete = Section::whereIn('is_demo',$isDemo)->delete();
        $groupDelete = Group::whereIn('is_demo',$isDemo)->delete();
        $studentDelete = Student::whereIn('is_demo',$isDemo)->delete();
        $subjectDelete = Subject::whereIn('is_demo',$isDemo)->delete();
        $roomDelete = Room::whereIn('is_demo',$isDemo)->delete();
        $teacherDelete = Teacher::whereIn('is_demo',$isDemo)->delete();
        $guardianDelete = Guardian::whereIn('is_demo',$isDemo)->delete();
        $assignmentDelete = Assignment::whereIn('is_demo',$isDemo)->delete();
        $syllabusDelete = Syllabus::whereIn('is_demo',$isDemo)->delete();
        $classRutineDelete = ClassRutine::whereIn('is_demo',$isDemo)->delete();

        Toastr::success('Successfully Clean Data.', 'Success', ["progressbar" => true]);
        return redirect(route('rollback'));
    }

}
