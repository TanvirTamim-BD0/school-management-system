<?php
namespace App\Helpers;
use Auth;

class bloodGroup{

    public static function getBloodGroup()
    {
        $data = array('A+','A-','B+','B-'
                        ,'O+','O-','AB+','AB-');
        return $data;
    }
}
