<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'author_id',
        'book_category_id',
        'rack_no_id',
        'subject_name',
        'mrp_price',
        'quantity',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function authorData()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    
    public function libraryBookCategoryData()
    {
        return $this->belongsTo(LibraryBookCategory::class, 'book_category_id');
    }
    
    public function RackData()
    {
        return $this->belongsTo(RackNo::class, 'rack_no_id');
    }
}

