<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count();
        $pendingStudents = Student::where('status', 'Inactive')->count();
        $approvedStudents = Student::where('status', 'Active')->count();

        $totalBranches = User::count();
        $activeBranches = User::where('status', 'active')->count();
        $inactiveBranches = User::where('status', 'inactive')->count();

        $student = Student::paginate(100);

        return view('admin.dashboard', compact(
           'student' , 'totalStudents', 'pendingStudents', 'approvedStudents', 'totalBranches', 'activeBranches', 'inactiveBranches'
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

    public function account()
    {
        return view('admin.account.account');
    }

    public function accountStore(Request $request)
    {
        $admin = auth()->guard('admin')->user();
        if (! $admin) {
            return back()
                ->withErrors(['auth' => 'Admin not authenticated.'])
                ->withInput();
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'password' => 'nullable|min:4|confirmed',
        ];

        $messages = [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 4 characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'validation_error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            return back()->withErrors($validator)->withInput();
        }

        try {
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');

            if ($request->filled('password')) {
                $admin->password = bcrypt($request->input('password'));
            }

            $admin->save();

            return back()->with('success', 'Account information updated successfully!');
        } catch (\Throwable $e) {
            \Log::error('Admin Account Update Error: '.$e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong while updating account.',
                ], 500);
            }

            return back()->with('error', 'Something went wrong while updating account.');
        }
    }

    public function general()
    {
        $setting = Setting::first();

        return view('admin.general.general', compact('setting'));
    }

    public function settingStore(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'fav_icon' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp,ico',
            'side_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp,ico',
        ]);

        $setting = Setting::first() ?? new Setting;

        $setting->meta_title = $request->meta_title;
        $setting->meta_desc = $request->meta_desc;
        $setting->meta_tag = $request->meta_tag ? explode(',', $request->meta_tag) : [];

        if ($request->hasFile('fav_icon')) {
            $fav_icon = $request->file('fav_icon');
            $fav_icon_name = 'fav_icon_'.time().'.'.$fav_icon->getClientOriginalExtension();
            $fav_icon->move(public_path('upload'), $fav_icon_name);
            $setting->fav_icon = 'upload/'.$fav_icon_name;
        }

        if ($request->hasFile('side_logo')) {
            $side_logo = $request->file('side_logo');
            $side_logo_name = 'side_logo_'.time().'.'.$side_logo->getClientOriginalExtension();
            $side_logo->move(public_path('upload'), $side_logo_name);
            $setting->side_logo = 'upload/'.$side_logo_name;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
