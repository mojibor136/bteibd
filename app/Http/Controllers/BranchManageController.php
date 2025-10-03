<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    public function store(Request $request)
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

            return redirect()->route('admin.branches.index')->with('success', 'Registration successful. Please wait for admin approval.');

        } catch (\Exception $e) {
            \Log::error('Unexpected error', ['error' => $e->getMessage()]);

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

        $images = ['directorPhoto', 'institutePhoto', 'nationalIdPhoto', 'signaturePhoto'];
        foreach ($images as $img) {
            if ($request->hasFile($img)) {
                if ($user->$img && file_exists(public_path($user->$img))) {
                    unlink(public_path($user->$img));
                }
                $file = $request->file($img);
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $user->$img = 'uploads/'.$filename;
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

        return redirect()->route('admin.branches.index')->with('success', 'User updated successfully.');
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

        return redirect()->route('admin.branches.index')->with('success', 'User deleted successfully.');
    }
}
