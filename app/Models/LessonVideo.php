<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonDocument extends Model
{
    use HasFactory;

    protected $table = 'lesson_documents';

    protected $fillable = [
        'lesson_id',
        'file_path',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}