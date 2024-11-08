<?php
namespace App\Helpers;
use Auth;

class Exam{

    public static function getExam()
    {
        $data = array('Mid Term','Annual');
        return $data;
    }
}
