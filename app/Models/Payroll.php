<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_to_id',
        'invoice_id',
        'total_salary',
        'payment_method',
        'payment_comment',
        'payment_date',
        'payment_month',
        'payment_year',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function paymentToData()
    {
        return $this->belongsTo(User::class, 'payment_to_id');
    }
}
