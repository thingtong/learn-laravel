<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $fillable = [
        'lesson_id',
        'question',
        'a',
        'b',
        'c',
        'd',
        'correct',
        'score',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
