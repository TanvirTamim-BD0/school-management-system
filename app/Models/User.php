<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles ,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'package_id',
        'login_id',
        'name',
        'email',
        'password',
        'mobile',
        'role',
        'image',
        'status',
        'address',
        'device_token',
        'admin_id',
        'manager_id',
        'verify_code',
        'verify_expires_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();
        return $permission_groups;
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name','short_name','id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }

    //To get user details data with user id....
    public function getUserDeatilsData($userId)
    {
        $data = User::where('id', $userId)->first();
        if(isset($data) && $data != null){
            //To check role...
            if($data->role != null){
                if($data->role == 'teacher'){
                    $userDetailData = Teacher::where('teacher_phone', $data->mobile)->first();
                }else if($data->role == 'librarian'){
                    $userDetailData = Librarian::where('librarian_phone', $data->mobile)->first();
                }else if($data->role == 'accountent'){
                    $userDetailData = Accountent::where('accountent_phone', $data->mobile)->first();
                }else{
                    $userDetailData = null;
                }

                return $userDetailData;
            }
        }
    }
}
