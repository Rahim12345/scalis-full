<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'cover',
        'title_az',
        'slug_az',
        'title_en',
        'slug_en',
        'title_ru',
        'slug_ru',
        'sub_title_az',
        'sub_title_en',
        'sub_title_ru',
        'content_az',
        'content_en',
        'content_ru',
        'status',
        'hits'
    ];
}
