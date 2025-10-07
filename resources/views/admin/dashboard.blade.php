@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    @include('error.error')
    <div class="p-6 pt-2 space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Admin Dashboard</h1>
            <span class="text-gray-500">Welcome, {{ auth()->guard('admin')->user()->name }}</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-4">
            <div class="bg-white shadow rounded-lg p-5 flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm">Total Students</h3>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalStudents }}</p>
                </div>
                <i class="ri-group-line text-4xl text-blue-500"></i>
            </div>

            <div class="bg-white shadow rounded-lg p-5 flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm">Pending Students</h3>
                    <p class="text-2xl font-bold text-yellow-500">{{ $pendingStudents }}</p>
                </div>
                <i class="ri-time-line text-4xl text-yellow-400"></i>
            </div>

            <div class="bg-white shadow rounded-lg p-5 flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm">Approved Students</h3>
                    <p class="text-2xl font-bold text-green-500">{{ $approvedStudents }}</p>
                </div>
                <i class="ri-checkbox-circle-line text-4xl text-green-400"></i>
            </div>

            <div class="bg-white shadow rounded-lg p-5 flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm">Total Branches</h3>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalBranches }}</p>
                </div>
                <i class="ri-building-line text-4xl text-indigo-500"></i>
            </div>

            <div class="bg-white shadow rounded-lg p-5 flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm">Active Branches</h3>
                    <p class="text-2xl font-bold text-green-500">{{ $activeBranches }}</p>
                </div>
                <i class="ri-check-line text-4xl text-green-400"></i>
            </div>

            <div class="bg-white shadow rounded-lg p-5 flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm">Inactive Branches</h3>
                    <p class="text-2xl font-bold text-red-500">{{ $inactiveBranches }}</p>
                </div>
                <i class="ri-close-circle-line text-4xl text-red-400"></i>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg mt-8">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-700">Recent Students</h2>
                <a href="{{ route('admin.students.index') }}" class="text-blue-500 hover:underline text-sm">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Registration No</th>
                            <th class="px-6 py-3">Phone</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($student as $index => $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $index + 1 }}</td>
                                <td class="px-6 py-3 font-medium text-gray-900">{{ $item->name }}</td>
                                <td class="px-6 py-3">{{ $item->registration_no }}</td>
                                <td class="px-6 py-3">{{ $item->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-3">
                                    @if ($item->status == 'Active')
                                        <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-600">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-600">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-3">{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $student->links() }}
            </div>
        </div>
    </div>
@endsection
