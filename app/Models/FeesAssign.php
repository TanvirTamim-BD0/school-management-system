<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fees_type_id',
        'class_id',
        'fees_amount',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function feesTypeData()
    {
        return $this->belongsTo(FeesType::class, 'fees_type_id');
    }
    
    public function classData()
    {
        return $this->belongsTo(Classname::class, 'class_id');
    }
}
