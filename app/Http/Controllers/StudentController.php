<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
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
                        ->orWhere('registration_no', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $student = $query->orderBy('id', 'desc')->paginate(100);

            return view('admin.student.index', compact('student'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching students.');
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
        $student = Student::findOrFail($id);
        $courses = Course::where('status', 'Active')->get();

        return view('admin.student.edit', compact('student', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'institute_name' => 'required|string|max:255',
            'roll' => 'required|string|max:50',
            'registration_no' => "required|string|max:50|unique:students,registration_no,{$id}",
            'student_type' => 'required|string|max:50',
            'course_duration' => 'required|string|max:50',
            'session' => 'required|string|max:50',
            'course_name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $student = Student::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('profile_photo')) {
                if ($student->profile_photo && file_exists(public_path($student->profile_photo))) {
                    unlink(public_path($student->profile_photo));
                }

                $file = $request->file('profile_photo');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/'), $filename);
                $data['profile_photo'] = 'uploads/'.$filename;
            }

            $student->update($data);

            return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Student update error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while updating the student.');
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);

            if ($student->profile_photo && file_exists(public_path($student->profile_photo))) {
                unlink(public_path($student->profile_photo));
            }

            $student->delete();

            return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Student delete error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while deleting the student.');
        }
    }

    public function toggleStatus($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->status = ($student->status === 'Active') ? 'Inactive' : 'Active';
            $student->save();

            return redirect()->route('admin.students.index')->with('success', 'Student status updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Student status toggle error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while updating the student status.');
        }
    }

    public function studentMark(Request $request)
    {
        try {
            $search = $request->input('search');

            $studentMarks = StudentCourse::with('student')
                ->when($search, function ($query) use ($search) {
                    $query->whereHas('student', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('student_id', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->paginate(10);

            return view('admin.student.mark.index', compact('studentMarks', 'search'));
        } catch (\Exception $e) {
            \Log::error('Student Mark Fetch Error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Failed to load student marks. Please try again later.');
        }
    }

    public function studentMarkCreate()
    {
        $students = Student::where('status', 'Active')->get();

        return view('admin.student.mark.create', compact('students'));
    }

    public function studentMarkStore(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'written' => 'required|numeric|min:0',
                'practical' => 'required|numeric|min:0',
                'viva' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'full_mark' => 'required|numeric|min:0',
                'cgpa' => 'required|numeric|min:0|max:4',
                'grade' => 'required|string|max:5',
            ]);

            $exists = StudentCourse::where('student_id', $request->student_id)->first();
            if ($exists) {
                return redirect()
                    ->back()
                    ->with('error', 'This student already has a mark entry.')
                    ->withInput();
            }

            StudentCourse::create([
                'student_id' => $request->student_id,
                'written' => $request->written,
                'practical' => $request->practical,
                'viva' => $request->viva,
                'total' => $request->total,
                'full_mark' => $request->full_mark,
                'cgpa' => $request->cgpa,
                'grade' => $request->grade,
            ]);

            return redirect()
                ->route('admin.students.mark.index')
                ->with('success', 'Student course mark added successfully!');
        } catch (\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Student Mark Store Error: '.$e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while saving the student mark. Please try again later.')
                ->withInput();
        }
    }

    public function studentMarkDestroy($id)
    {
        try {
            $mark = StudentCourse::findOrFail($id);
            $mark->delete();

            return redirect()->route('admin.students.mark.index')
                ->with('success', 'Student mark deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Student Mark Delete Error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Failed to delete student mark.');
        }
    }
}
