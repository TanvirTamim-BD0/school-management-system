<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'user_id',
        'is_demo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //To get single author data...
    public static function getSingleAuthorData($authorId)
    {
        $data = Author::where('id', $authorId)->first();
        return $data;
    }
}
