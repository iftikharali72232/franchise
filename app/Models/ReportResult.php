<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportResult extends Model
{
    use HasFactory;

    protected $table = 'reports_result';
    protected $fillable = [
        'report_id',
        'section_id',
        'question_id',
        'answer',
        'attachments',
        'description',
        'admin_attachments',
        'admin_note'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
