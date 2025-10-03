<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Course::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $courses = $query->orderBy('id', 'desc')->paginate(100);

            return view('admin.course.index', compact('courses'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching courses.');
        }
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:courses,name',
                'description' => 'required|string|max:1000',
                'price' => 'required|numeric|min:0',
            ]);

            Course::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'status' => 'Active',
            ]);

            return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
        } catch (\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Course store error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while creating the course.')->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);

            return view('admin.course.edit', compact('course'));
        } catch (\Exception $e) {
            \Log::error('Course edit error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while loading the edit form.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|'.Rule::unique('courses', 'name')->ignore($course->id),
                'description' => 'required|string|max:1000',
                'price' => 'required|numeric|min:0',
            ]);

            $course->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
        } catch (\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Course update error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while updating the course.')->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->status = ($course->status === 'Active') ? 'Inactive' : 'Active';
            $course->save();

            return redirect()->route('admin.courses.index')->with('success', 'Course status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Course status toggle error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while updating course status.');
        }
    }

    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            return redirect()->route('admin.courses.index')->with('success', 'Semester deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Semester delete error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while deleting semester.');
        }
    }
}
