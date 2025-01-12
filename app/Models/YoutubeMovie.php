<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeMovie extends Model
{
    protected $fillable = [
        'url',
        'title',
        'filming_date',
        'up_flg',
    ];

    protected $primaryKey = 'movie_youtube_id';
}