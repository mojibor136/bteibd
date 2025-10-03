@extends('admin.layouts.app')
@section('title', 'Edit Pricing')
@section('content')
    @include('error.error')
    <div class="w-full flex flex-col gap-4 mb-20">
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Pricing</h2>
                <a href="{{ route('admin.pricing.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Pricing
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Home</a> / Pricing
                    /
                    Create
                </p>
                <a href="{{ route('admin.pricing.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Pricing
                </a>
            </div>
        </div>

        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('admin.pricing.update', $pricing->id) }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
                @csrf
                @method('PUT')
                <div class="col-span-2">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Pricing Name</label>
                    <input type="text" name="name" placeholder="Pricing Name"
                        value="{{ old('name', $pricing->name) }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
        text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>


                <div class="col-span-2">
                    <label class="block text-md text-gray-700 mb-1 sm:mb-2 font-medium">Price</label>
                    <input type="number" name="price" placeholder="Pricing Price"
                        value="{{ old('price', $pricing->price) }}"
                        class="w-full rounded-md bg-white text-gray-900 border px-3 sm:px-4 py-2
        text-sm sm:text-base outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 border-gray-300">
                </div>

                <div class="col-span-2 md:col-span-2 mt-2">
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 disabled:cursor-not-allowed 
                text-white py-2.5 text-sm sm:text-base transition-all duration-200 transform">
                        Update Pricing
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
