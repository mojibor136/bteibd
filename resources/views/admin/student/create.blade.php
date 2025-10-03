@extends('admin.layouts.app')
@section('title', 'Add New Student')
@section('content')
    @include('error.error')
    <div class="w-full flex flex-col gap-4 mb-20">
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Student</h2>
                <a href="{{ route('admin.students.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Student
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Home</a> / Student / Create
                </p>
                <a href="{{ route('admin.students.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Student
                </a>
            </div>
        </div>

        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
                @csrf

                <!-- Name -->
                <div class="col-span-2">
                    <label class="block text-md text-gray-700 mb-1">Student Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Student Name"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Father Name -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Father Name</label>
                    <input type="text" name="father_name" value="{{ old('father_name') }}" placeholder="Father Name"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Mother Name -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Mother Name</label>
                    <input type="text" name="mother_name" value="{{ old('mother_name') }}" placeholder="Mother Name"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Date of Birth -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Institute Name -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Institute Name</label>
                    <input type="text" name="institute_name" value="{{ old('institute_name') }}"
                        placeholder="Institute Name"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Roll -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Roll</label>
                    <input type="text" name="roll" value="{{ old('roll') }}" placeholder="Roll Number"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Registration No -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Registration No</label>
                    <input type="text" name="registration_no" value="{{ old('registration_no') }}"
                        placeholder="Registration No"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Student Type -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Student Type</label>
                    <select name="student_type"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2.5
        text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                        <option value="">Select Type</option>
                        <option value="Regular" {{ old('student_type') == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Irregular" {{ old('student_type') == 'Irregular' ? 'selected' : '' }}>Irregular
                        </option>
                    </select>
                </div>

                <!-- Session -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Session</label>
                    <input type="text" name="session" value="{{ old('session') }}" placeholder="e.g. 2022-23"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Course Name -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Course</label>
                    <select name="course_name"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2.5
        text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                        <option value="">Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->name }}"
                                {{ old('course_name') == $course->name ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Course Duration -->
                <div>
                    <label class="block text-md text-gray-700 mb-1">Duration</label>
                    <select name="course_duration"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2.5
        text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                        <option value="">Select Duration</option>

                        <!-- Months -->
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }} Month"
                                {{ old('course_duration') == $i . ' Month' ? 'selected' : '' }}>
                                {{ $i }} Month{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor

                        <!-- Years -->
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }} Year"
                                {{ old('course_duration') == $i . ' Year' ? 'selected' : '' }}>
                                {{ $i }} Year{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Profile Photo -->
                <div class="col-span-2">
                    <label class="block text-md text-gray-700 mb-1">Student Photo</label>
                    <input type="file" name="profile_photo"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <!-- Submit -->
                <div class="col-span-2 mt-4">
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 text-sm sm:text-base transition-all duration-200">
                        Create Student
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
