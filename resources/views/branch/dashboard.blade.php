@extends('branch.layouts.app')
@section('title', 'Branch Dashboard')
@section('content')
    @include('error.error')
    <div class="p-6 pt-2 space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Branch Dashboard</h1>
            <span class="text-gray-500">Welcome, {{ auth()->user()->director_name }}</span>
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
                    <h3 class="text-gray-500 text-sm">Average CGPA</h3>
                    <p class="text-2xl font-bold text-purple-500">{{ number_format($averageCGPA, 2) }}</p>
                </div>
                <i class="ri-bar-chart-line text-4xl text-purple-400"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-800 font-semibold mb-4">Enrollment Trend</h3>
                <canvas id="enrollmentChart" height="200"></canvas>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-gray-800 font-semibold mb-4">CGPA Analysis</h3>
                <canvas id="cgpaChart" height="200"></canvas>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        const enrollmentChart = new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($enrollmentMonths) !!},
                datasets: [{
                    label: 'New Students',
                    data: {!! json_encode($enrollmentCounts) !!},
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79,70,229,0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                },
            }
        });

        const cgpaCtx = document.getElementById('cgpaChart').getContext('2d');
        const cgpaChart = new Chart(cgpaCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($cgpaLabels) !!},
                datasets: [{
                    label: 'Students',
                    data: {!! json_encode($cgpaCounts) !!},
                    backgroundColor: '#10b981',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
