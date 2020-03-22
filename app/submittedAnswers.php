<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class submittedAnswers extends Model
{
    protected $fillable = ['mcqId','studentId','questionId','answer','correct'];
}
