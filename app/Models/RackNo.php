<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackNo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rack_no',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
