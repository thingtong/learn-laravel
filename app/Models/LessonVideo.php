<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_id','file_path'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}