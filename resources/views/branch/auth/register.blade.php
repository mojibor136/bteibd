@extends('layouts.app')
@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 via-gray-900 to-indigo-950 p-4">
        <div class="w-full max-w-4xl">
            <div
                class="relative rounded-xl p-6 sm:p-8 md:p-10 bg-gray-800 bg-opacity-80 backdrop-blur-sm border border-gray-700 shadow-lg hover:shadow-indigo-500/70 transition-all duration-300">
                <div class="text-center mb-6 sm:mb-8">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-100">Branch Registration</h1>
                    <p class="text-xs sm:text-sm text-gray-400 mt-1 sm:mt-2">Fill the form below to register</p>
                </div>

                <form action="{{ route('branch.register.submit') }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
                    @csrf

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Institute
                            Name</label>
                        <input type="text" name="instituteName" placeholder="Institute Name"
                            value="{{ old('instituteName') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Director Name</label>
                        <input type="text" name="directorName" placeholder="Director Name"
                            value="{{ old('directorName') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Father's Name</label>
                        <input type="text" name="fatherName" placeholder="Father's Name" value="{{ old('fatherName') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Mother's Name</label>
                        <input type="text" name="motherName" placeholder="Mother's Name" value="{{ old('motherName') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Email</label>
                        <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Mobile Number</label>
                        <input type="text" name="mobileNumber" placeholder="Mobile Number"
                            value="{{ old('mobileNumber') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Address</label>
                        <input type="text" name="address" placeholder="Address" value="{{ old('address') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Post Office</label>
                        <input type="text" name="postOffice" placeholder="Post Office" value="{{ old('postOffice') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Upazila</label>
                        <input type="text" name="upazila" placeholder="Upazila" value="{{ old('upazila') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">District</label>
                        <input type="text" name="district" placeholder="District" value="{{ old('district') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Username</label>
                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Password</label>
                        <input type="password" name="password" placeholder="Password"
                            class="w-full rounded-lg bg-gray-900 text-gray-100 border px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Director
                            Photo</label>
                        <input type="file" name="directorPhoto" accept="image/*"
                            class="w-full text-xs sm:text-sm text-gray-300 border rounded-lg px-2 sm:px-3 py-2 bg-gray-900 cursor-pointer file:rounded-full file:border-0 file:bg-indigo-600 file:text-gray-100 hover:file:bg-indigo-700 transition-colors border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Institute
                            Photo</label>
                        <input type="file" name="institutePhoto" accept="image/*"
                            class="w-full text-xs sm:text-sm text-gray-300 border rounded-lg px-2 sm:px-3 py-2 bg-gray-900 cursor-pointer file:rounded-full file:border-0 file:bg-indigo-600 file:text-gray-100 hover:file:bg-indigo-700 transition-colors border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">National ID
                            Photo</label>
                        <input type="file" name="nationalIdPhoto" accept="image/*"
                            class="w-full text-xs sm:text-sm text-gray-300 border rounded-lg px-2 sm:px-3 py-2 bg-gray-900 cursor-pointer file:rounded-full file:border-0 file:bg-indigo-600 file:text-gray-100 hover:file:bg-indigo-700 transition-colors border-gray-700">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2 font-medium">Signature
                            Photo</label>
                        <input type="file" name="signaturePhoto" accept="image/*"
                            class="w-full text-xs sm:text-sm text-gray-300 border rounded-lg px-2 sm:px-3 py-2 bg-gray-900 cursor-pointer file:rounded-full file:border-0 file:bg-indigo-600 file:text-gray-100 hover:file:bg-indigo-700 transition-colors border-gray-700">
                    </div>

                    <div class="col-span-1 md:col-span-2 mt-4 sm:mt-6">
                        <button type="submit"
                            class="w-full rounded-lg bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 disabled:cursor-not-allowed text-white font-semibold py-2.5 sm:py-3 text-sm sm:text-base transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                            Register
                        </button>
                    </div>
                </form>

                <div class="mt-6 sm:mt-8 text-center">
                    <p class="text-xs sm:text-sm text-gray-400">
                        Already have an account?
                        <a href="/login"
                            class="text-indigo-400 hover:text-indigo-300 hover:underline transition-colors duration-200 font-medium">Sign
                            in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
