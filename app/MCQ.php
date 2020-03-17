<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCQ extends Model
{
    protected $fillable = ['subjectId','staffId','semId','name','id'];
}
