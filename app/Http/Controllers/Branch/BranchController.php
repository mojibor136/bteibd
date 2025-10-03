<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BranchController extends Controller
{
    public function dashboard()
    {
        $authId = auth()->id();

        $studentsQuery = Student::where('author_id', $authId)
            ->where('author_role', 'branch');

        $totalStudents = $studentsQuery->count();
        $pendingStudents = (clone $studentsQuery)->where('status', 'pending')->count();
        $approvedStudents = (clone $studentsQuery)->where('status', 'approved')->count();
        $averageCGPA = (clone $studentsQuery)->avg('cgpa_result');

        $enrollmentMonths = [];
        $enrollmentCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M Y');
            $enrollmentMonths[] = $month;
            $enrollmentCounts[] = (clone $studentsQuery)
                ->whereMonth('created_at', now()->subMonths($i)->month)
                ->whereYear('created_at', now()->subMonths($i)->year)
                ->count();
        }

        $cgpaLabels = ['<2.5', '2.5-3.0', '3.0-3.5', '3.5-4.0', '4.0'];
        $cgpaCounts = [];
        foreach ($cgpaLabels as $label) {
            if ($label == '<2.5') {
                $cgpaCounts[] = (clone $studentsQuery)->where('cgpa_result', '<', 2.5)->count();
            } elseif ($label == '2.5-3.0') {
                $cgpaCounts[] = (clone $studentsQuery)->whereBetween('cgpa_result', [2.5, 3.0])->count();
            } elseif ($label == '3.0-3.5') {
                $cgpaCounts[] = (clone $studentsQuery)->whereBetween('cgpa_result', [3.0, 3.5])->count();
            } elseif ($label == '3.5-4.0') {
                $cgpaCounts[] = (clone $studentsQuery)->whereBetween('cgpa_result', [3.5, 4.0])->count();
            } else {
                $cgpaCounts[] = (clone $studentsQuery)->where('cgpa_result', 4.0)->count();
            }
        }

        return view('branch.dashboard', compact(
            'totalStudents', 'pendingStudents', 'approvedStudents', 'averageCGPA',
            'enrollmentMonths', 'enrollmentCounts', 'cgpaLabels', 'cgpaCounts'
        ));
    }

    public function index()
    {
        $students = Student::where('author_id', auth()->id())->get();

        return view('branch.students.index', compact('students'));
    }

    public function pending()
    {
        $students = Student::where('status', 'pending')->where('author_id', auth()->id())->get();

        return view('branch.students.pending', compact('students'));
    }

    public function approved()
    {
        $students = Student::where('status', 'approved')->where('author_id', auth()->id())->get();

        return view('branch.students.approved', compact('students'));
    }

    public function create()
    {
        return view('branch.students.create');
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

            return redirect()->route('home')->with('success', 'Registration successful. Please wait for admin approval.');

        } catch (\Exception $e) {
            \Log::error('Unexpected error', ['error' => $e->getMessage()]);

            return back()->withErrors(['error' => 'Something went wrong: '.$e->getMessage()])->withInput();
        }
    }
}
