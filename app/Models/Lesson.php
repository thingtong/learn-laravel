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
        'description',
        'order_no',
    ];

    // บทเรียน -> หลักสูตร
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // บทเรียน -> วิดีโอ
    public function videos()
    {
        return $this->hasMany(LessonVideo::class, 'lesson_id');
    }

    // บทเรียน -> เอกสาร
    public function documents()
    {
        return $this->hasMany(LessonDocument::class, 'lesson_id');
    }

    // เช็คว่าผู้เรียนเรียนจบหรือยัง
    // public function completedBy($userId)
    // {
    //     return LessonProgress::where('lesson_id', $this->id)
    //         ->where('user_id', $userId)
    //         ->where('completed', 1)
    //         ->exists();
    // }
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