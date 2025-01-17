<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'password',
        'function',
        'job_number',
        'face_id',
        'description',
    ];

    protected $hidden = [
        'password',
    ];
}
