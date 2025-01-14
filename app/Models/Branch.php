<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'branch_name',
        'branch_no',
        'region',
        'city',
        'location',
        'header_image',
        'status',
    ];

    // Optional: Define relationships if the branch is related to other models, like an organization
    // public function organization()
    // {
    //     return $this->belongsTo(Organization::class);
    // }
}
