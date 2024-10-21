<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillStudent extends Model
{
    use HasFactory;
protected $table = 'skill_student';
    protected $fillable = [
        'skill_id',
        'student_id',
    ];
}
