@extends('branch.layouts.app')
@section('title', 'Account Setting')
@section('content')

    <div class="w-full flex flex-col gap-6 mb-20">

        <!-- Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 gap-2">
            <h2 class="text-2xl font-bold text-gray-800">Account Settings</h2>
            <p class="text-gray-600 text-sm">Update your personal and institute information</p>
        </div>

        <!-- Form Card -->
        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('branch.account.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @php
                    $user = auth()->guard('web')->user();
                @endphp

                <!-- Institute Name -->
                <div class="mt-4">
                    <label for="institute_name" class="block text-md font-medium text-gray-700 mb-1.5">
                        Institute Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="institute_name" name="institute_name" placeholder="Enter Institute Name"
                        value="{{ old('institute_name', $user->institute_name) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                    @error('institute_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Director Name -->
                <div class="mt-4">
                    <label for="director_name" class="block text-md font-medium text-gray-700 mb-1.5">
                        Director Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="director_name" name="director_name" placeholder="Enter Director Name"
                        value="{{ old('director_name', $user->director_name) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                    @error('director_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Father Name -->
                <div class="mt-4">
                    <label for="father_name" class="block text-md font-medium text-gray-700 mb-1.5">
                        Father Name
                    </label>
                    <input type="text" id="father_name" name="father_name" placeholder="Enter Father Name"
                        value="{{ old('father_name', $user->father_name) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Mother Name -->
                <div class="mt-4">
                    <label for="mother_name" class="block text-md font-medium text-gray-700 mb-1.5">
                        Mother Name
                    </label>
                    <input type="text" id="mother_name" name="mother_name" placeholder="Enter Mother Name"
                        value="{{ old('mother_name', $user->mother_name) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Mobile Number -->
                <div class="mt-4">
                    <label for="mobile_number" class="block text-md font-medium text-gray-700 mb-1.5">
                        Mobile Number
                    </label>
                    <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number"
                        value="{{ old('mobile_number', $user->mobile_number) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label for="email" class="block text-md font-medium text-gray-700 mb-1.5">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Enter Email Address"
                        value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <label for="address" class="block text-md font-medium text-gray-700 mb-1.5">
                        Address
                    </label>
                    <input type="text" id="address" name="address" placeholder="Enter Address"
                        value="{{ old('address', $user->address) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Post Office -->
                <div class="mt-4">
                    <label for="post_office" class="block text-md font-medium text-gray-700 mb-1.5">
                        Post Office
                    </label>
                    <input type="text" id="post_office" name="post_office" placeholder="Enter Post Office"
                        value="{{ old('post_office', $user->post_office) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Upazila -->
                <div class="mt-4">
                    <label for="upazila" class="block text-md font-medium text-gray-700 mb-1.5">
                        Upazila
                    </label>
                    <input type="text" id="upazila" name="upazila" placeholder="Enter Upazila"
                        value="{{ old('upazila', $user->upazila) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- District -->
                <div class="mt-4">
                    <label for="district" class="block text-md font-medium text-gray-700 mb-1.5">
                        District
                    </label>
                    <input type="text" id="district" name="district" placeholder="Enter District"
                        value="{{ old('district', $user->district) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Username -->
                <div class="mt-4">
                    <label for="username" class="block text-md font-medium text-gray-700 mb-1.5">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Enter Username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-md font-medium text-gray-700 mb-1.5">
                        Password
                    </label>
                    <input type="password" id="password" name="password" placeholder="Enter new password"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block text-md font-medium text-gray-700 mb-1.5">
                        Confirm Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm new password"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Save Account
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
