@extends('admin.layouts.app')
@section('title', 'Student Details')
@section('content')
    <div class="w-full space-y-6 text-gray-700">

        <!-- Student Info -->
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Student Information</h2>
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-200">
                    @if ($student->profile_photo)
                        <img src="{{ asset($student->profile_photo) }}" class="w-full h-full object-cover">
                    @else
                        <i class="ri-user-line text-4xl text-gray-400 flex items-center justify-center h-full w-full"></i>
                    @endif
                </div>
                <div>
                    <p class="font-semibold text-gray-800">{{ $student->name }}</p>
                    <p>Registration No: {{ $student->registration_no }}</p>
                    <p>Date of Birth: {{ $student->date_of_birth ? $student->date_of_birth->format('d M Y') : 'N/A' }}</p>
                    <p>Status: {{ $student->status }}</p>
                </div>
            </div>
        </div>

        <!-- Semesters -->
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Semesters</h2>
            @if ($student->semesters->count() > 0)
                <table class="min-w-full table-auto border border-gray-200">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-center">Cgpa</th>
                            <th class="px-4 py-2 text-center">Grade</th>
                            <th class="px-4 py-2 text-left">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($student->semesters as $index => $studentSemester)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 text-left">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 text-left">{{ $studentSemester->semester->name }}</td>
                                <td class="px-4 py-2 text-center">{{ $studentSemester->cgpa }}</td>
                                <td class="px-4 py-2 text-center">{{ $studentSemester->grade }}</td>
                                <td class="px-4 py-2 text-left">{{ $studentSemester->created_at->format('d M Y') ?? 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No semesters found.</p>
            @endif
        </div>

        <!-- Marks -->
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Marks</h2>
            @if ($student->marks->count() > 0)
                <table class="min-w-full table-auto border border-gray-200">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-center">Written</th>
                            <th class="px-4 py-2 text-center">Practical</th>
                            <th class="px-4 py-2 text-center">Viva</th>
                            <th class="px-4 py-2 text-center">Total</th>
                            <th class="px-4 py-2 text-center">Full Mark</th>
                            <th class="px-4 py-2 text-center">CGPA</th>
                            <th class="px-4 py-2 text-center">Grade</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($student->marks as $index => $mark)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 text-left">{{ $index + 1 }}</td>
                                <td class="text-center px-4 py-2">{{ $mark->written }}</td>
                                <td class="text-center px-4 py-2">{{ $mark->practical }}</td>
                                <td class="text-center px-4 py-2">{{ $mark->viva }}</td>
                                <td class="text-center px-4 py-2">{{ $mark->total }}</td>
                                <td class="text-center px-4 py-2">{{ $mark->full_mark }}</td>
                                <td class="text-center px-4 py-2">{{ $mark->cgpa }}</td>
                                <td class="text-center px-4 py-2">{{ $mark->grade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No marks found.</p>
            @endif
        </div>
    </div>
@endsection
