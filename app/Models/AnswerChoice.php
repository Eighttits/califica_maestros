<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'multiple_choice_id',
        'question_id',
        'submission_id',
    ];
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
    public function choice()
    {
        return $this->belongTo(MultipleChoice::class);
    }

}
