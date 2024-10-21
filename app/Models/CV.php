<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
  use HasFactory;
    protected $table = 'cvs';
    protected $fillable = [
        'student_id',
        'lesson_id',
        'hard_skill_id',
        'soft_skill_id',
        'project_id',
        'experience_id',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function hardSkill()
    {
        return $this->belongsTo(HardSkill::class);
    }

    public function softSkill()
    {
        return $this->belongsTo(SoftSkill::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
