<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'form_id',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function multipleChoices()
    {
        return $this->hasMany(MultipleChoice::class);
    }
}
