<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'user_id',
        'request_id',
        'status'
    ];

    public function results()
    {
        return $this->hasMany(ReportResult::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
