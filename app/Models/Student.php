<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'author_id',
        'author_role',
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'institute_name',
        'roll',
        'registration_no',
        'student_type',
        'course_duration',
        'session',
        'status',
        'course_name',
        'cgpa_result',
        'profile_photo',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function semesters()
    {
        return $this->hasMany(StudentSemester::class)->with('semester');
    }

    public function marks()
    {
        return $this->hasMany(StudentCourse::class);
    }
}
