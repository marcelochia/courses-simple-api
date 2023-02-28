<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use HasAttributes;

    protected $fillable = [
        'number',
        'name',
        'category',
        'prerequisite',
        'teacher_name',
        'duration'
    ];
}
