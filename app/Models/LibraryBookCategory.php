<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBookCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_category_name',
        'user_id',
        'is_demo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //To get single library book category data...
    public static function getSingleLBCData($libraryBookCategoryId)
    {
        $data = LibraryBookCategory::where('id', $libraryBookCategoryId)->first();
        return $data;
    }
}
