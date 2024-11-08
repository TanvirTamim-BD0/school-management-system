<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueReply extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'role_id',
        'reply_user_id',
        'queue_id',
        'queue_reply_text',
        'status'
    ];

}
