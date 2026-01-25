<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'description',
        'order_no',
    ];

   public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->hasMany(LessonVideo::class);
    }

    public function documents()
    {
        return $this->hasMany(LessonDocument::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function completedBy($userId)
    {
        return $this->progress()
            ->where('user_id', $userId)
            ->where('completed', 1)
            ->exists();
    }

}