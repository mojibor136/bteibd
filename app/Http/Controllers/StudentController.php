<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Student::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->$q->where('registration_no', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $student = $query->orderBy('id', 'desc')->paginate(100);

            return view('admin.student.index', compact('student'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching pricing.');
        }
    }

    public function create()
    {
        $courses = Course::where('status', 'Active')->get();

        return view('admin.student.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'institute_name' => 'required|string|max:255',
            'roll' => 'required|string|max:50',
            'registration_no' => 'required|string|max:50|unique:students,registration_no',
            'student_type' => 'required|string|max:50',
            'course_duration' => 'required|string|max:50',
            'session' => 'required|string|max:50',
            'course_name' => 'required|string|max:255',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            $data['status'] = 'Inactive';
            $data['cgpa_result'] = '0';
            $data['author_role'] = 'admin';
            $data['author_id'] = auth('admin')->id();

            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/'), $filename);
                $data['profile_photo'] = 'uploads/'.$filename;
            }

            Student::create($data);

            return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            \Log::error('Student store error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while creating the student.');
        }
    }

    public function edit($id)
    {
        return view('admin.student.edit', compact('id'));
    }
}
