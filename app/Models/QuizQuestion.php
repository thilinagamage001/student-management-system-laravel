<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [

        'course_id',
        'question_type',
        'question',
        'marks',
        'model_answer',
        'status'

    ];

    public function course()
    {
        return $this->belongsTo(
            Course::class
        );
    }

    public function mcqOption()
    {
        return $this->hasOne(
            McqOption::class
        );
    }
}
