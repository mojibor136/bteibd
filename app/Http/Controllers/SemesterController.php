<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SemesterController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Semester::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $semesters = $query->orderBy('id', 'desc')->paginate(100);

            return view('admin.semester.index', compact('semesters'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching semesters.');
        }
    }

    public function create()
    {
        try {
            return view('admin.semester.create');
        } catch (\Exception $e) {
            Log::error('Semester create error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while loading create form.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:semesters,name|max:255',
            ]);

            Semester::create([
                'name' => $request->name,
                'status' => 'Active',
            ]);

            return redirect()->route('admin.semesters.index')->with('success', 'Semester created successfully!');
        } catch (\Exception $e) {
            Log::error('Semester store error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while creating semester.');
        }
    }

    public function edit($id)
    {
        try {
            $semester = Semester::findOrFail($id);

            return view('admin.semester.edit', compact('semester'));
        } catch (\Exception $e) {
            Log::error('Semester edit error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while loading edit form.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $semester = Semester::findOrFail($id);

            $request->validate([
                'name' => 'required|string|unique:semesters,name,'.$semester->id.'|max:255',
            ]);

            $semester->update([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.semesters.index')->with('success', 'Semester updated successfully!');
        } catch (\Exception $e) {
            Log::error('Semester update error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while updating semester.');
        }
    }

    public function destroy($id)
    {
        try {
            $semester = Semester::findOrFail($id);
            $semester->delete();

            return redirect()->route('admin.semesters.index')->with('success', 'Semester deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Semester delete error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while deleting semester.');
        }
    }

    public function toggleStatus($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->status = $semester->status === 'Active' ? 'Inactive' : 'Active';
        $semester->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
