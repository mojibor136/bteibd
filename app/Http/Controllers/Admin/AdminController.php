<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count();
        $pendingStudents = Student::where('status', 'pending')->count();
        $approvedStudents = Student::where('status', 'approved')->count();
        $averageCGPA = Student::avg('cgpa_result');

        $enrollmentMonths = [];
        $enrollmentCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M Y');
            $enrollmentMonths[] = $month;
            $enrollmentCounts[] = Student::whereMonth('created_at', now()->subMonths($i)->month)->count();
        }

        $cgpaLabels = ['<2.5', '2.5-3.0', '3.0-3.5', '3.5-4.0', '4.0'];
        $cgpaCounts = [];
        foreach ($cgpaLabels as $label) {
            if ($label == '<2.5') {
                $cgpaCounts[] = Student::where('cgpa_result', '<', 2.5)->count();
            } elseif ($label == '2.5-3.0') {
                $cgpaCounts[] = Student::whereBetween('cgpa_result', [2.5, 3.0])->count();
            } elseif ($label == '3.0-3.5') {
                $cgpaCounts[] = Student::whereBetween('cgpa_result', [3.0, 3.5])->count();
            } elseif ($label == '3.5-4.0') {
                $cgpaCounts[] = Student::whereBetween('cgpa_result', [3.5, 4.0])->count();
            } else {
                $cgpaCounts[] = Student::where('cgpa_result', 4.0)->count();
            }
        }

        return view('admin.dashboard', compact(
            'totalStudents', 'pendingStudents', 'approvedStudents', 'averageCGPA',
            'enrollmentMonths', 'enrollmentCounts', 'cgpaLabels', 'cgpaCounts'
        ));
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 4 characters',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
