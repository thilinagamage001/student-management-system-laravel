<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
        return $this->belongsTo(User::class,);
    }
}
