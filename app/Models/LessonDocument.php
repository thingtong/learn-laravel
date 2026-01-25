<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonDocument extends Model
{
    protected $fillable = [
        'lesson_id','file_path'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
