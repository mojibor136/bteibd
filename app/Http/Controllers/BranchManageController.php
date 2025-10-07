<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BranchManageController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $branches = $query->orderBy('id', 'desc')->paginate(100);

        return view('admin.branch.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branch.create');
    }

    public function work($id){
        $user = User::find($id);

        $student = Student::where('author_id' , $user->id)->where('author_role' , 'branch')->paginate(100);

        return view('admin.branch.work' , compact('user' , 'student'));
    }

    public function store(Request $request)
    {
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

            $images = [
                'director_photo' => 'directorPhoto',
                'institute_photo' => 'institutePhoto',
                'national_id_photo' => 'nationalIdPhoto',
                'signature_photo' => 'signaturePhoto',
            ];

            $paths = [];
            foreach ($images as $dbField => $formField) {
                if ($request->hasFile($formField)) {
                    $file = $request->file($formField);
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('uploads'), $filename);
                    $paths[$dbField] = 'uploads/'.$filename;
                }
            }

            User::create([
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
                'director_photo' => $paths['director_photo'] ?? null,
                'institute_photo' => $paths['institute_photo'] ?? null,
                'national_id_photo' => $paths['national_id_photo'] ?? null,
                'signature_photo' => $paths['signature_photo'] ?? null,
            ]);

            return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
        } catch (\Exception $e) {
            Log::error('Branch store failed', ['error' => $e->getMessage()]);

            return back()->withErrors(['error' => 'Something went wrong: '.$e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $branch = User::findOrFail($id);

        return view('admin.branch.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'instituteName' => 'required|string|max:255',
            'directorName' => 'required|string|max:255',
            'fatherName' => 'required|string|max:255',
            'motherName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'mobileNumber' => ['required', 'string', 'regex:/^01[3-9]\d{8}$/'],
            'address' => 'required|string|max:500',
            'postOffice' => 'required|string|max:255',
            'upazila' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,'.$user->id,
            'password' => 'nullable|string|min:4',
            'directorPhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'institutePhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nationalIdPhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signaturePhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $images = [
            'director_photo' => 'directorPhoto',
            'institute_photo' => 'institutePhoto',
            'national_id_photo' => 'nationalIdPhoto',
            'signature_photo' => 'signaturePhoto',
        ];

        foreach ($images as $dbField => $formField) {
            if ($request->hasFile($formField)) {
                if ($user->$dbField && file_exists(public_path($user->$dbField))) {
                    unlink(public_path($user->$dbField));
                }
                $file = $request->file($formField);
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $user->$dbField = 'uploads/'.$filename;
            }
        }

        $user->institute_name = $request->instituteName;
        $user->director_name = $request->directorName;
        $user->father_name = $request->fatherName;
        $user->mother_name = $request->motherName;
        $user->email = $request->email;
        $user->mobile_number = $request->mobileNumber;
        $user->address = $request->address;
        $user->post_office = $request->postOffice;
        $user->upazila = $request->upazila;
        $user->district = $request->district;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $images = ['director_photo', 'institute_photo', 'national_id_photo', 'signature_photo'];
        foreach ($images as $img) {
            if ($user->$img && file_exists(public_path($user->$img))) {
                unlink(public_path($user->$img));
            }
        }

        $user->delete();

        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $branch = User::findOrFail($id);
        $branch->status = $branch->status === 'Active' ? 'Inactive' : 'Active';
        $branch->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function show($id)
    {
        $branch = User::findOrFail($id);

        return view('admin.branch.show', compact('branch'));
    }
}
