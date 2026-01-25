<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Quiz extends Model
{
     use HasFactory;

    protected $table = 'quizzes';

    protected $fillable = [
        'lesson_id','question','score',  'course_id',
        'title',
        'time_limit',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function choices()
    {
        return $this->hasMany(QuizChoice::class);
    }
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }



}