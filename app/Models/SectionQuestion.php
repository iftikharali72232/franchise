<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionQuestion extends Model
{
    use HasFactory;
    protected $table = "section_questions";
    protected $fillable = ['section_id', 'question', 'answer1', 'answer2', 'answer3'];
}
