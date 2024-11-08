<?php
namespace App\Helpers;
use Auth;

class HelperFeesType{

    public static function getBasicFeesType()
    {
        $data = array('Tution Fee (Jan)','Tution Fee (Feb)','Tution Fee (Mar)','Tution Fee (Apr)'
                        ,'Tution Fee (May)','Tution Fee (Jun)','Tution Fee (Jul)','Tution Fee (Aug)'
                        ,'Tution Fee (Sep)','Tution Fee (Oct)','Tution Fee (Nov)','Tution Fee (Dec)');
        return $data;
    }
}