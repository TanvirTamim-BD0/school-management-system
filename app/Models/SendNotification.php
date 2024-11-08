<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'to_account_id',
        'title',
        'description',
        'status',
        'is_mobile_sms',
        'is_email_sms',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   
    public function roleData()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
