<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function formQuestions()
    {
        return $this->hasMany(FormQuestion::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
