<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class LeaveApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'leave_application_from',
        'leave_application_to',
        'leave_category_id',
        'start_date',
        'end_date',
        'reason',
        'attachment_file',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function roleData()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
    public function leaveCategoryData()
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_category_id');
    }
}
