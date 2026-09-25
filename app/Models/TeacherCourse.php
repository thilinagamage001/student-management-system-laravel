<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $fillable = [
        'teacher_id',
        'course_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
