<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'mail',
        'title',
        'category_id',
        'content',
    ];
    protected $primaryKey = 'contact_id';
}