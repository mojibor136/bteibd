@extends('admin.layouts.app')
@section('title', 'Student Management')
@section('content')
    @include('error.error')
    <div class="w-full mb-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-4 border-b rounded-md mb-4">
            <div class="flex flex-col gap-2 w-full md:w-2/3">
                <h1 class="text-xl font-bold text-gray-800">Student Management</h1>
                <p class="text-sm text-gray-500 ml-1">Manage your student and their transactions efficiently</p>
            </div>
            <div class="flex flex-row gap-2 mt-3 md:mt-0 w-full md:w-auto items-start sm:items-center">
                <a href="{{ route('admin.students.create') }}"
                    class="flex items-center gap-2 h-10 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow font-medium transition-all duration-200">
                    <i class="ri-add-line text-lg"></i> Create Student
                </a>
            </div>
        </div>

        <!-- Search + Filter -->
        <form method="GET" action="{{ route('admin.students.index') }}"
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2 sm:gap-4">
            <div class="flex flex-col sm:flex-row w-full sm:w-2/3 gap-2">
                <div class="relative w-full sm:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search students..."
                        class="w-full pl-10 pr-4 h-10 text-gray-700 rounded-md border border-gray-300 focus:ring-1 focus:ring-blue-600 focus:outline-none text-sm transition-all duration-150" />
                    <i
                        class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-base"></i>
                </div>
                <div class="relative w-full sm:w-1/2">
                    <select name="status"
                        class="w-full px-4 h-10 text-gray-700 rounded-md border border-gray-300 focus:ring-1 focus:ring-blue-600 focus:outline-none text-sm transition-all duration-150">
                        <option value="">All Status</option>
                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit"
                    class="flex justify-center items-center px-4 py-2 h-10 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium transition-all duration-150 mt-2 sm:mt-0">
                    <i class="ri-search-line mr-1"></i> Search
                </button>
            </div>
            <a href="{{ route('admin.students.index') }}"
                class="flex justify-center items-center px-4 py-2 h-10 md:w-auto w-full rounded-md bg-red-600 hover:bg-red-700 text-white font-medium transition-all duration-150 mt-2 sm:mt-0">
                Reset
            </a>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-600 text-white text-sm font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Student Information</th>
                        <th class="px-4 py-3 text-left">Course</th>
                        <th class="px-4 py-3 text-left">CGPA</th>
                        <th class="px-4 py-3 text-left">Date of Brith</th>
                        <th class="px-4 py-3 text-right pr-8">Status/Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                    @foreach ($student as $index => $data)
                        <tr class="hover:bg-gray-100 transition-colors cursor-pointer">
                            <td class="px-4 py-3 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex gap-2 items-center">
                                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
                                        @if ($data->profile_photo)
                                            <img src="{{ asset($data->profile_photo) }}" alt="Photo"
                                                class="w-full h-full object-cover">
                                        @else
                                            <i
                                                class="ri-user-line text-3xl text-gray-400 flex items-center justify-center h-full"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $data->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $data->registration_no }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $data->course_name }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $data->cgpa_result == 0 || $data->cgpa_result === null ? 'No Semester' : $data->cgpa_result }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $data->date_of_birth ? $data->date_of_birth->format('d M Y') : 'N/A' }}
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <div class="flex justify-end items-center gap-1">
                                    <a href="{{ route('admin.students.edit', $data->id) }}"
                                        class="inline-flex items-center justify-center w-10 h-8 bg-green-500 hover:bg-green-600 text-white rounded shadow"
                                        title="Edit">
                                        <i class="ri-edit-2-line text-md"></i>
                                    </a>

                                    <a href="{{ route('admin.students.show', $data->id) }}"
                                        class="inline-flex items-center justify-center w-10 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded shadow"
                                        title="View">
                                        <i class="ri-eye-line text-md"></i>
                                    </a>

                                    <form action="{{ route('admin.students.status', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-3 h-8 
                                        {{ $data->status == 'Active' ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-500 hover:bg-gray-600' }}
                                        text-white rounded shadow text-sm font-medium"
                                            title="Change Status">
                                            {{ $data->status == 'Active' ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.students.delete', $data->id) }}" method="POST"
                                        onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ডেটা ডিলিট করতে চান?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-10 h-8 bg-red-500 hover:bg-red-600 text-white rounded shadow cursor-pointer"
                                            title="Delete">
                                            <i class="ri-delete-bin-6-line text-md"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($student->hasPages())
            <div class="mt-4 flex justify-end">
                @if ($student->onFirstPage())
                    <span class="px-4 py-2 mr-2 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed">
                        Previous
                    </span>
                @else
                    <a href="{{ $student->previousPageUrl() }}"
                        class="px-4 py-2 mr-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Previous
                    </a>
                @endif

                @if ($student->hasMorePages())
                    <a href="{{ $student->nextPageUrl() }}"
                        class="px-4 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Next
                    </a>
                @else
                    <span class="px-4 py-2 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed">
                        Next
                    </span>
                @endif
            </div>
        @endif
    </div>
@endsection
