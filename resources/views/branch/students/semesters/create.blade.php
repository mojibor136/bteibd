@extends('branch.layouts.app')
@section('title', 'Add New Student Semester')
@section('content')
    @include('error.error')

    <div class="w-full flex flex-col gap-4 mb-20">
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Add Student Semester</h2>
                <a href="{{ route('branch.students.semesters.index') }}"
                    class="block bg-teal-500 text-white px-4 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Student Semesters
                </a>
            </div>
            <div class="text-gray-600 text-sm">
                <a href="{{ route('branch.dashboard') }}" class="text-blue-600 hover:underline">Home</a> /
                <span>Student Semester / Create</span>
            </div>
        </div>

        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('branch.students.semesters.store') }}" method="POST"
                class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <div>
                    <label class="block text-md text-gray-700 mb-1">Student</label>
                    <select name="student_id"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300">
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->roll }})
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-md text-gray-700 mb-1">Semester</label>
                    <select name="semester_id"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300">
                        <option value="">Select Semester</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                {{ $semester->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('semester_id')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-md text-gray-700 mb-1">Grade</label>
                    <input type="text" name="grade" value="{{ old('grade') }}" placeholder="A+, A, B+ ..."
                        class="w-full rounded-md bg-white text-gray-900 border px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300">
                </div>

                <div>
                    <label class="block text-md text-gray-700 mb-1">CGPA</label>
                    <input type="number" step="0.01" name="cgpa" value="{{ old('cgpa') }}" placeholder="3.75"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-indigo-500 border-gray-300">
                </div>

                <div class="col-span-2 mt-4">
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 text-sm transition-all duration-200">
                        Create Student Semester
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
