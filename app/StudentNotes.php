<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentNotes extends Model
{
    protected $fillable = ['file','staffId','studentId','subjectId','name'];
}
