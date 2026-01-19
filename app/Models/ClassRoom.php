<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRoom extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'course_id',
        'class_name',
    ];

    // กลุ่ม -> หลักสูตร
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // กลุ่ม -> นักเรียน
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'class_user',
            'class_id',
            'user_id'
        );
    }
}