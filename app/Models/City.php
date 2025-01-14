<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cities'; // Set the custom primary key
    protected $primaryKey = 'sno';
    public function branches()
    {
        return $this->hasMany(Branch::class, 'city', 'sno'); // 'city' is the foreign key, and 'sno' is the primary key on City model
    }
}
