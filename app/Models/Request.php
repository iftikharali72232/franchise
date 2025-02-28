<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'auditor_id',
        'email',
        'date',
        'time',
        'code',
        'section_id',
        'questions'
    ];
    public function reports()
    {
        return $this->hasMany(Report::class, 'request_id');
    }
}
