@extends('admin.layouts.app')
@section('title', 'Edit Branch')
@section('content')
    @include('error.error')

    <div class="w-full flex flex-col gap-4 mb-20">
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Edit Branch</h2>
                <a href="{{ route('admin.branches.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Branch
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Home</a> /
                    Branch / Edit
                </p>
                <a href="{{ route('admin.branches.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Branch
                </a>
            </div>
        </div>

        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('admin.branches.update', $branch->id) }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
                @csrf
                @method('PUT')

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Institute Name</label>
                    <input type="text" name="instituteName" value="{{ old('instituteName', $branch->institute_name) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Director Name</label>
                    <input type="text" name="directorName" value="{{ old('directorName', $branch->director_name) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Father's Name</label>
                    <input type="text" name="fatherName" value="{{ old('fatherName', $branch->father_name) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Mother's Name</label>
                    <input type="text" name="motherName" value="{{ old('motherName', $branch->mother_name) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $branch->email) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Mobile Number</label>
                    <input type="text" name="mobileNumber" value="{{ old('mobileNumber', $branch->mobile_number) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Address</label>
                    <input type="text" name="address" value="{{ old('address', $branch->address) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Post Office</label>
                    <input type="text" name="postOffice" value="{{ old('postOffice', $branch->post_office) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Upazila</label>
                    <input type="text" name="upazila" value="{{ old('upazila', $branch->upazila) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">District</label>
                    <input type="text" name="district" value="{{ old('district', $branch->district) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Username</label>
                    <input type="text" name="username" value="{{ old('username', $branch->username) }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Password</label>
                    <input type="password" name="password"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <small class="text-gray-500">Leave blank if you don't want to change it.</small>
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-2 font-medium">Director Photo</label>
                    @if ($branch->director_photo)
                        <img src="{{ asset($branch->director_photo) }}" alt="Director Photo"
                            class="w-24 h-24 object-cover rounded border mb-2">
                    @endif
                    <input type="file" name="directorPhoto" accept="image/*"
                        class="w-full text-sm text-gray-700 border rounded-md px-2 py-2 bg-white cursor-pointer border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-2 font-medium">Institute Photo</label>
                    @if ($branch->institute_photo)
                        <img src="{{ asset($branch->institute_photo) }}" alt="Institute Photo"
                            class="w-24 h-24 object-cover rounded border mb-2">
                    @endif
                    <input type="file" name="institutePhoto" accept="image/*"
                        class="w-full text-sm text-gray-700 border rounded-md px-2 py-2 bg-white cursor-pointer border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-2 font-medium">National ID Photo</label>
                    @if ($branch->national_id_photo)
                        <img src="{{ asset($branch->national_id_photo) }}" alt="National ID"
                            class="w-24 h-24 object-cover rounded border mb-2">
                    @endif
                    <input type="file" name="nationalIdPhoto" accept="image/*"
                        class="w-full text-sm text-gray-700 border rounded-md px-2 py-2 bg-white cursor-pointer border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-2 font-medium">Signature Photo</label>
                    @if ($branch->signature_photo)
                        <img src="{{ asset($branch->signature_photo) }}" alt="Signature"
                            class="w-24 h-24 object-cover rounded border mb-2">
                    @endif
                    <input type="file" name="signaturePhoto" accept="image/*"
                        class="w-full text-sm text-gray-700 border rounded-md px-2 py-2 bg-white cursor-pointer border-gray-300">
                </div>

                <div class="col-span-1 md:col-span-2 mt-4">
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 text-sm sm:text-base transition-all duration-200">
                        Update Branch
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
