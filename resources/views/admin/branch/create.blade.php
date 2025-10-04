@extends('admin.layouts.app')
@section('title', 'Add New Branch')
@section('content')
    @include('error.error')
    <div class="w-full flex flex-col gap-4 mb-20">
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Branch</h2>
                <a href="{{ route('admin.branches.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Branch
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Home</a> / Branch
                    /
                    Create
                </p>
                <a href="{{ route('admin.branches.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Branch
                </a>
            </div>
        </div>

        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('admin.branches.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
                @csrf

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Institute Name</label>
                    <input type="text" name="instituteName" placeholder="Institute Name"
                        value="{{ old('instituteName') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Director Name</label>
                    <input type="text" name="directorName" placeholder="Director Name" value="{{ old('directorName') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Father's Name</label>
                    <input type="text" name="fatherName" placeholder="Father's Name" value="{{ old('fatherName') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Mother's Name</label>
                    <input type="text" name="motherName" placeholder="Mother's Name" value="{{ old('motherName') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Email</label>
                    <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Mobile Number</label>
                    <input type="text" name="mobileNumber" placeholder="Mobile Number" value="{{ old('mobileNumber') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Address</label>
                    <input type="text" name="address" placeholder="Address" value="{{ old('address') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Post Office</label>
                    <input type="text" name="postOffice" placeholder="Post Office" value="{{ old('postOffice') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Upazila</label>
                    <input type="text" name="upazila" placeholder="Upazila" value="{{ old('upazila') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">District</label>
                    <input type="text" name="district" placeholder="District" value="{{ old('district') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Username</label>
                    <input type="text" name="username" placeholder="Username" value="{{ old('username') }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Password</label>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
    text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Director Photo</label>
                    <input type="file" name="directorPhoto" accept="image/*"
                        class="w-full text-md text-gray-700 border rounded-md px-2 sm:px-3 py-2 bg-white cursor-pointer 
                file:rounded-full file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition-colors border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Institute Photo</label>
                    <input type="file" name="institutePhoto" accept="image/*"
                        class="w-full text-md text-gray-700 border rounded-md px-2 sm:px-3 py-2 bg-white cursor-pointer 
                file:rounded-full file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition-colors border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">National ID
                        Photo</label>
                    <input type="file" name="nationalIdPhoto" accept="image/*"
                        class="w-full text-md text-gray-700 border rounded-md px-2 sm:px-3 py-2 bg-white cursor-pointer 
                file:rounded-full file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition-colors border-gray-300">
                </div>

                <div class="col-span-1">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Signature Photo</label>
                    <input type="file" name="signaturePhoto" accept="image/*"
                        class="w-full text-md text-gray-700 border rounded-md px-2 sm:px-3 py-2 bg-white cursor-pointer 
                file:rounded-full file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition-colors border-gray-300">
                </div>

                <div class="col-span-1 md:col-span-2 mt-4 sm:mt-6">
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 disabled:cursor-not-allowed 
                text-white py-2.5 text-sm sm:text-base transition-all duration-200">
                        Create Branch
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
