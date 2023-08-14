<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'students_teachers', 'teacher_id', 'student_id');
    }
    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
