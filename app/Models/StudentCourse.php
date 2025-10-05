<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    protected $fillable = [
        'student_id',
        'written',
        'practical',
        'viva',
        'total',
        'full_mark',
        'cgpa',
        'grade',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
