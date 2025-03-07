<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $table = 'letters';

    protected $fillable = [
        'branch_id',
        'branch_name',
        'owner_email',
        'offer_title',
        'offer_message',
        'attachment',
    ];

    /**
     * Get the branch that owns the letter.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}

