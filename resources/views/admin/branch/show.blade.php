@extends('admin.layouts.app')

@section('title', 'Branch Details')

@section('content')
    <div class="w-full">
        <div class="bg-white shadow rounded-lg p-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Branch Details</h2>
                    <p class="text-sm text-gray-500">Complete information of branch</p>
                </div>
                <a href="{{ route('admin.branches.index') }}"
                    class="mt-3 sm:mt-0 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium transition">
                    <i class="ri-arrow-left-line mr-1"></i> Back
                </a>
            </div>

            <!-- Branch Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div>
                        <span class="text-gray-500 text-sm">Institute Name:</span>
                        <p class="text-gray-800 font-medium">{{ $branch->institute_name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Director Name:</span>
                        <p class="text-gray-800 font-medium">{{ $branch->director_name }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Username:</span>
                        <p class="text-gray-800 font-medium">{{ $branch->username }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Email:</span>
                        <p class="text-gray-800 font-medium">{{ $branch->email ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div>
                        <span class="text-gray-500 text-sm">Phone:</span>
                        <p class="text-gray-800 font-medium">{{ $branch->mobile_number }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Address:</span>
                        <p class="text-gray-800 font-medium">{{ $branch->address ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Status:</span>
                        <p class="text-xs">
                            <span
                                class="px-4 py-0.5 rounded-3xl font-medium
                            {{ $branch->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $branch->status }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <span class="text-gray-500 text-sm">Created At:</span>
                        <p class="text-gray-800 font-medium">{{ $branch->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Gallery -->
        <div class="bg-white shadow rounded-lg p-6 mt-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Branch Gallery</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @php
                    $photos = [
                        'Director Photo' => $branch->director_photo,
                        'Institute Photo' => $branch->institute_photo,
                        'National ID Photo' => $branch->national_id_photo,
                        'Signature Photo' => $branch->signature_photo,
                    ];
                @endphp

                @foreach ($photos as $label => $photo)
                    @if ($photo)
                        <div class="relative group">
                            <img src="{{ asset($photo) }}" alt="{{ $label }}"
                                class="w-full h-40 object-cover rounded-lg shadow group-hover:opacity-90 transition">
                            <a href="{{ asset($photo) }}" target="_blank"
                                class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 rounded-lg transition">
                                <i class="ri-eye-line text-white text-xl"></i>
                            </a>
                            <p class="mt-2 text-sm text-center text-gray-700">{{ $label }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            @if (empty($branch->director_photo) &&
                    empty($branch->institute_photo) &&
                    empty($branch->national_id_photo) &&
                    empty($branch->signature_photo))
                <p class="col-span-4 text-gray-500 text-center">No images available</p>
            @endif
        </div>
    </div>
@endsection
