<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'reg_no',
        'phone',
        'dob',
        'age',
        'address',
        'gender',
        'nic',
        'profile_picture',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'teacher_courses', 'teacher_id', 'course_id');
    }
}
