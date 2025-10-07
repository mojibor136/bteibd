<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $student = Student::where('status', 'Active')->get();

        return view('welcome', compact('student'));
    }

    public function search(Request $request)
    {
        try {
            $studentId = $request->input('studentId');
            if (strlen($studentId) < 6) {
                return response()->json(['status' => 'error', 'message' => 'Enter at least 6 digits']);
            }
            $student = Student::with([
                'semesters.semester',
                'marks',
            ])
                ->where('roll', $studentId)
                ->orWhere('registration_no', $studentId)
                ->first();
            if (! $student) {
                return response()->json(['status' => 'error', 'message' => 'Student not found']);
            }

            return response()->json([
                'status' => 'success',
                'student' => [
                    'name' => $student->name,
                    'father_name' => $student->father_name,
                    'mother_name' => $student->mother_name,
                    'date_of_birth' => $student->date_of_birth,
                    'institute_name' => $student->institute_name,
                    'roll' => $student->roll,
                    'registration_no' => $student->registration_no,
                    'student_type' => $student->student_type,
                    'course_duration' => $student->course_duration,
                    'session' => $student->session,
                    'course_name' => $student->course_name,
                    'cgpa_result' => $student->cgpa_result,
                    'profile_photo' => $student->profile_photo,
                ],
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    public function course()
    {
        $courses = Course::all();

        return view('course', compact('courses'));
    }

    public function branch()
    {
        $user = User::all();

        return view('branche', compact('user'));
    }

    public function result()
    {
        return view('result');
    }
}
