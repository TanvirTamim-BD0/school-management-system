<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accountent_name',
        'accountent_email',
        'accountent_phone',
        'gender',
        'blood_group',
        'religion',
        'address',
        'joining_date',
        'date_of_birth',
        'salary',
        'designation',
        'accountent_photo',
        'is_demo',
    ];
    
    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //To get accountent details data...
    public static function getSingleAccountentDetailWithEmail($id)
    {
        //To fetch single accountent & user data...
        $singleUserData = User::where('id', $id)->first();
        $singleAccountentData = Accountent::where('accountent_email', $singleUserData->email)->first();

        return $singleAccountentData;
    }


    public static function getSingleAccountent($mobile)
    {
        $data = Accountent::where('accountent_phone', $mobile)->first();
        return $data;
    }
}
