<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expense_title',
        'expense_date',
        'expense_amount',
        'expense_note',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
