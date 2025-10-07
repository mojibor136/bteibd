<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Pricing;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\StudentSemester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BranchController extends Controller
{
    public function dashboard()
    {
        $authId = auth()->id();

        $studentsQuery = Student::where('author_id', $authId)
            ->where('author_role', 'branch');

        $student = (clone $studentsQuery)->latest()->paginate(20);

        $totalStudents = $studentsQuery->count();
        $pendingStudents = (clone $studentsQuery)->where('status', 'Inactive')->count();
        $approvedStudents = (clone $studentsQuery)->where('status', 'Active')->count();

        return view('branch.dashboard', compact(
            'totalStudents', 'pendingStudents', 'approvedStudents', 'student'
        ));
    }

    public function account()
    {
        return view('branch.account.account');
    }

    public function accountStore(Request $request)
    {
        $user = auth()->guard('web')->user();

        try {
            $validated = $request->validate([
                'institute_name' => 'required|string|max:255',
                'director_name' => 'required|string|max:255',
                'father_name' => 'nullable|string|max:255',
                'mother_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'mobile_number' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'post_office' => 'nullable|string|max:100',
                'upazila' => 'nullable|string|max:100',
                'district' => 'nullable|string|max:100',
                'username' => 'nullable|string|max:100',
                'password' => 'nullable|string|confirmed|min:4',
            ]);

            if ($request->filled('password')) {
                $validated['password'] = bcrypt($request->password);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return back()->with('success', 'Account updated successfully!');
        } catch (\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: '.$e->getMessage())->withInput();
        }
    }

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

            $student = $query->orderBy('id', 'desc')->where('author_id', auth()->id())->paginate(100);

            return view('branch.students.index', compact('student'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching students.');
        }
    }

    public function pending(Request $request)
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

            $student = $query->orderBy('id', 'desc')->where('status', 'Inactive')->where('author_id', auth()->id())->paginate(100);

            return view('branch.students.index', compact('student'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching students.');
        }

        return view('branch.students.pending', compact('student'));
    }

    public function pricing(Request $request)
    {
        try {
            $query = Pricing::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $pricing = $query->orderBy('id', 'desc')->paginate(100);

            return view('branch.pricing', compact('pricing'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching pricing.');
        }
    }

    public function approved(Request $request)
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

            $student = $query->orderBy('id', 'desc')->where('status', 'Active')->where('author_id', auth()->id())->paginate(100);

            return view('branch.students.index', compact('student'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching students.');
        }

        return view('branch.students.approved', compact('student'));
    }

    public function create()
    {
        $courses = Course::where('status', 'Active')->get();

        return view('branch.students.create', compact('courses'));
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
            $data['author_role'] = 'branch';
            $data['author_id'] = auth('web')->id();

            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/'), $filename);
                $data['profile_photo'] = 'uploads/'.$filename;
            }

            Student::create($data);

            return redirect()->route('branch.students.index')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            \Log::error('Student store error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while creating the student.');
        }
    }

    public function show($id)
    {
        try {
            $student = Student::with([
                'semesters.semester',
                'marks',
            ])->findOrFail($id);

            return view('branch.students.show', compact('student'));
        } catch (\Exception $e) {
            \Log::error('Student View Error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Failed to load student data.');
        }
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $courses = Course::where('status', 'Active')->get();

        return view('branch.students.edit', compact('student', 'courses'));
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

            return redirect()->route('branch.students.index')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Student update error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while updating the student.');
        }
    }

    public function studentMark(Request $request)
    {
        try {
            $search = $request->input('search');
            $branchId = Auth::id();

            $studentMarks = StudentCourse::with('student')
                ->whereHas('student', function ($q) use ($branchId) {
                    $q->where('author_role', 'branch')
                        ->where('author_id', $branchId)
                        ->where('status', 'Active');
                })
                ->when($search, function ($query) use ($search) {
                    $query->whereHas('student', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('student_id', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->paginate(10)
                ->appends(['search' => $search]);

            return view('branch.students.mark.index', compact('studentMarks', 'search'));

        } catch (\Exception $e) {
            \Log::error('Student Mark Fetch Error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Failed to load student marks. Please try again later.');
        }
    }

    public function studentMarkCreate()
    {
        $students = Student::where('author_id', Auth::id())->where('author_role', 'branch')->where('status', 'Active')->get();

        return view('branch.students.mark.create', compact('students'));
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
                ->route('branch.students.mark.index')
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

            return redirect()->route('branch.students.mark.index')
                ->with('success', 'Student mark deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Student Mark Delete Error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Failed to delete student mark.');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('branch.login')->with('success', 'Logged out successfully.');
    }

    public function showLoginForm()
    {
        return view('branch.auth.login');
    }

    public function showRegisterForm()
    {
        return view('branch.auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:4',
        ], [
            'username.required' => 'Username is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 4 characters',
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user) {
            return back()->withErrors(['login' => 'User not found'])->withInput();
        }

        if ($user->status == 'inactive') {
            return back()->withErrors(['login' => 'Your account is inactive. Please contact support.'])->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('branch.dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['login' => 'Invalid username or password'])->withInput();
    }

    public function register(Request $request)
    {
        try {
            try {
                $validated = $request->validate([
                    'instituteName' => 'required|string|max:255',
                    'directorName' => 'required|string|max:255',
                    'fatherName' => 'required|string|max:255',
                    'motherName' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'mobileNumber' => 'required|string|regex:/^01[3-9]\d{8}$/',
                    'address' => 'required|string|max:500',
                    'postOffice' => 'required|string|max:255',
                    'upazila' => 'required|string|max:255',
                    'district' => 'required|string|max:255',
                    'username' => 'required|string|unique:users,username',
                    'password' => 'required|string|min:4',
                    'directorPhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'institutePhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'nationalIdPhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'signaturePhoto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);
            } catch (ValidationException $e) {
                \Log::error('Validation failed', ['errors' => $e->errors()]);

                return back()->withErrors($e->errors())->withInput();
            }

            $images = ['directorPhoto', 'institutePhoto', 'nationalIdPhoto', 'signaturePhoto'];
            $paths = [];

            foreach ($images as $img) {
                try {
                    if ($request->hasFile($img)) {
                        $file = $request->file($img);
                        $filename = time().'_'.$file->getClientOriginalName();
                        $file->move(public_path('uploads'), $filename);
                        $paths[$img] = 'uploads/'.$filename;
                    } else {
                        throw new \Exception("$img file not found");
                    }
                } catch (\Exception $e) {
                    \Log::error('Image upload failed', ['image' => $img, 'error' => $e->getMessage()]);

                    return back()->withErrors(["$img" => "$img file not found"])->withInput();
                }
            }

            try {
                $user = User::create([
                    'institute_name' => $request->instituteName,
                    'director_name' => $request->directorName,
                    'father_name' => $request->fatherName,
                    'mother_name' => $request->motherName,
                    'email' => $request->email,
                    'mobile_number' => $request->mobileNumber,
                    'address' => $request->address,
                    'post_office' => $request->postOffice,
                    'upazila' => $request->upazila,
                    'district' => $request->district,
                    'username' => $request->username,
                    'status' => 'inactive',
                    'password' => bcrypt($request->password),
                    'director_photo' => $paths['directorPhoto'],
                    'institute_photo' => $paths['institutePhoto'],
                    'national_id_photo' => $paths['nationalIdPhoto'],
                    'signature_photo' => $paths['signaturePhoto'],
                ]);
            } catch (\Exception $e) {
                \Log::error('User creation failed', ['error' => $e->getMessage()]);

                return back()->withErrors(['user' => 'User creation failed: '.$e->getMessage()])->withInput();
            }

            return redirect()->route('home')->with('success', 'Registration successful. Please wait for branch approval.');

        } catch (\Exception $e) {
            \Log::error('Unexpected error', ['error' => $e->getMessage()]);

            return back()->withErrors(['error' => 'Something went wrong: '.$e->getMessage()])->withInput();
        }
    }

    public function studentSemester(Request $request)
    {
        $search = $request->input('search');
        $branchId = Auth::id();

        $studentSemesters = StudentSemester::with(['student', 'semester'])
            ->whereHas('student', function ($q) use ($branchId) {
                $q->where('author_role', 'branch')
                    ->where('author_id', $branchId)
                    ->where('status', 'Active');
            })
            ->when($search, function ($query, $search) {
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('registration_no', 'like', "%{$search}%")
                        ->orWhere('institute_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('semester', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('branch.students.semesters.index', compact('studentSemesters', 'search'));
    }

    public function studentSemesterCreate()
    {
        $semesters = Semester::where('status', 'Active')->get();
        $students = Student::where('author_role', 'branch')->where('author_id', Auth::id())->where('status', 'Active')->get();

        return view('branch.students.semesters.create', compact('semesters', 'students'));
    }

    public function studentSemesterStore(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'semester_id' => 'required|exists:semesters,id',
                'grade' => 'required|string|max:5',
                'cgpa' => 'required|numeric|min:0|max:4',
            ]);

            StudentSemester::create([
                'student_id' => $request->student_id,
                'semester_id' => $request->semester_id,
                'grade' => $request->grade,
                'cgpa' => $request->cgpa,
            ]);

            return redirect()
                ->route('branch.students.semesters.index')
                ->with('success', 'Student semester added successfully!');
        } catch (\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Student Semester Store Error: '.$e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while saving the student semester.')
                ->withInput();
        }
    }

    public function studentSemesterDestroy($id)
    {
        try {
            $studentSemester = StudentSemester::findOrFail($id);
            $studentSemester->delete();

            return redirect()
                ->route('branch.students.semesters.index')
                ->with('success', 'Student semester deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Student Semester Delete Error: '.$e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while deleting the student semester.');
        }
    }
}
