<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = ['question','op1','op2','op3','op4','answer','mcqId'];
}
