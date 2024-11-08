<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_no',
        'user_id',
        'is_demo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
