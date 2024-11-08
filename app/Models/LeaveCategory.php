<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_category'
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
