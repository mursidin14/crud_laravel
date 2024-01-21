<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'content',
    ];

    // function search
    public function scopeFilter($query)
    {
        if(request('search')) {
            return $query->where('title', 'like','%'. request('search'). '%')
                         ->orWhere('content', 'like', '%'. request('search').'%');
        }
    }
}
