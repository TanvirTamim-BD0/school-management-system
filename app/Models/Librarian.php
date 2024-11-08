<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Librarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'librarian_name',
        'librarian_email',
        'librarian_phone',
        'gender',
        'blood_group',
        'religion',
        'address',
        'joining_date',
        'date_of_birth',
        'salary',
        'designation',
        'librarian_photo',
        'is_demo',
    ];
    
    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //To get librarian details data...
    public static function getSingleLibrarianDetailWithEmail($id)
    {
        //To fetch single librarian & user data...
        $singleUserData = User::where('id', $id)->first();
        $singleLibrarianData = Librarian::where('librarian_email', $singleUserData->email)->first();

        return $singleLibrarianData;
    }


    public static function getSingleLibrarian($mobile)
    {
        $data = Librarian::where('librarian_phone', $mobile)->first();
        return $data;
    }
}
