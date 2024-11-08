<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesType extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fees_type',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
