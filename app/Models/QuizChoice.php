<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizChoice extends Model
{
    protected $fillable = [
        'quiz_id','choice_label','choice_text','is_correct'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
