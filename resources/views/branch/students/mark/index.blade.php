@extends('branch.layouts.app')
@section('title', 'Student Marks Management')
@section('content')
    @include('error.error')

    <div class="w-full mb-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-4 border-b rounded-md mb-4">
            <div class="flex flex-col gap-2 w-full md:w-2/3">
                <h1 class="text-xl font-bold text-gray-800">Student Marks Management</h1>
                <p class="text-sm text-gray-500 ml-1">Manage student marks efficiently</p>
            </div>
            <div class="flex flex-row gap-2 mt-3 md:mt-0 w-full md:w-auto items-start sm:items-center">
                <a href="{{ route('branch.students.mark.create') }}"
                    class="flex items-center gap-2 h-10 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow font-medium transition-all duration-200">
                    <i class="ri-add-line text-lg"></i> Add Student Mark
                </a>
            </div>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('branch.students.mark.index') }}"
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2 sm:gap-4">
            <div class="flex flex-col sm:flex-row w-full sm:w-2/3 gap-2">
                <div class="relative w-full sm:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by student name or ID..."
                        class="w-full pl-10 pr-4 h-10 text-gray-700 rounded-md border border-gray-300 focus:ring-1 focus:ring-blue-600 focus:outline-none text-sm transition-all duration-150" />
                    <i
                        class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-base"></i>
                </div>
                <button type="submit"
                    class="flex justify-center items-center px-4 py-2 h-10 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium transition-all duration-150 mt-2 sm:mt-0">
                    <i class="ri-search-line mr-1"></i> Search
                </button>
            </div>
            <a href="{{ route('branch.students.mark.index') }}"
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
                        <th class="px-4 py-3 text-left">Student</th>
                        <th class="px-4 py-3 text-center">Written</th>
                        <th class="px-4 py-3 text-center">Practical</th>
                        <th class="px-4 py-3 text-center">Viva</th>
                        <th class="px-4 py-3 text-center">Total</th>
                        <th class="px-4 py-3 text-center">Full Mark</th>
                        <th class="px-4 py-3 text-center">CGPA</th>
                        <th class="px-4 py-3 text-center">Grade</th>
                        <th class="px-4 py-3 text-right pr-8">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                    @forelse ($studentMarks as $index => $mark)
                        <tr class="hover:bg-gray-100 transition-colors cursor-pointer">
                            <td class="px-4 py-3 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $mark->student->name }} (Reg: {{ $mark->student->registration_no }})
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $mark->written }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $mark->practical }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $mark->viva }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $mark->total }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $mark->full_mark }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $mark->cgpa }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $mark->grade }}</td>
                            <td class="px-4 py-3 text-right whitespace-nowrap flex gap-1 justify-end">
                                <form action="{{ route('admin.students.mark.delete', $mark->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-24 h-8 bg-red-500 hover:bg-red-600 text-white rounded shadow"
                                        title="Delete">
                                        <i class="ri-delete-bin-6-line text-md mr-2"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-500">No student marks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($studentMarks->hasPages())
            <div class="mt-4 flex justify-end">
                @if ($studentMarks->onFirstPage())
                    <span class="px-4 py-2 mr-2 rounded-md bg-gray-100 text-gray-500 cursor-not-allowed">
                        Previous
                    </span>
                @else
                    <a href="{{ $studentMarks->previousPageUrl() }}"
                        class="px-4 py-2 mr-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Previous
                    </a>
                @endif

                @if ($studentMarks->hasMorePages())
                    <a href="{{ $studentMarks->nextPageUrl() }}"
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
