<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classname extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'user_id',
        'is_demo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //To get single class data...
    public static function getSingleClassData($classId)
    {
        $data = Classname::where('id', $classId)->first();
        return $data;
    }
}
