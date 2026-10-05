<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class McqOption extends Model
{
    protected $fillable = [

        'quiz_question_id',

        'option_a',
        'option_b',
        'option_c',
        'option_d',

        'correct_answer'

    ];

    public function question()
    {
        return $this->belongsTo(
            QuizQuestion::class,
            'quiz_question_id'
        );
    }
}
