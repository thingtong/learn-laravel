<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'description',
        'pass_score',
        'created_by',
    ];

    // หลักสูตร -> กลุ่มเรียน
    public function classes()
    {
        return $this->hasMany(ClassRoom::class, 'course_id');
    }

    // หลักสูตร -> บทเรียน
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id')
                    ->orderBy('order_no');
    }

    // หลักสูตร -> ข้อสอบ
    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'course_id');
    }
}
