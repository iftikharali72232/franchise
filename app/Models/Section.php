<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = "sections";
    protected $fillable = ['name', 'shows_to', 'image_path', 'default_section'];

    /**
     * Define a one-to-many relationship with SectionQuestion.
     */
    public function questions()
    {
        return $this->hasMany(SectionQuestion::class, 'section_id');
    }
}
