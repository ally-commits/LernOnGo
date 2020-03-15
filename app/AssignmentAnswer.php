<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentAnswer extends Model
{
    protected $fillable = ['answer','assignmentId','studentId'];
}
