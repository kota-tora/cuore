<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruit extends Model
{
    protected $fillable = [
        'name',
        'mail',
        'age',
        'gender',
        'attendance',
        'experience',
        'question'
    ];
    protected $primaryKey = 'recruit_id';
}