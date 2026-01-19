<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizResult extends Model
{
    use HasFactory;

    protected $table = 'quiz_results';

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'passed',
        'submitted_at',
    ];

    protected $casts = [
        'passed' => 'boolean',
        'submitted_at' => 'datetime',
    ];
}
