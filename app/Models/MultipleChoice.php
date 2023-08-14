<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoice extends Model
{
    use HasFactory;
    protected $fillable = ['answer','form_question_id'];

    public function formQuestion()
    {
        return $this->belongsTo(FormQuestion::class);
    }
    public function answerChoices()
    {
        return $this->hasMany(AnswerChoice::class);
    }
}
