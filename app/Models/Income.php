<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'income_title',
        'income_date',
        'income_amount',
        'income_note',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
