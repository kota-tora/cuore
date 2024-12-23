<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'name',
        'title',
        'type',
        'photo_date',
        'up_flg',
    ];

    protected $primaryKey = 'gallery_id';
}