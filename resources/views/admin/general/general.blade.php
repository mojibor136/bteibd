@extends('admin.layouts.app')
@section('title', 'General Setting')
@section('content')
    <div class="w-full flex flex-col gap-6 mb-20">

        <!-- Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 gap-2">
            <h2 class="text-2xl font-bold text-gray-800">General Settings</h2>
            <p class="text-gray-600 text-sm">Update your general site settings</p>
        </div>

        <!-- Form Card -->
        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @php
                    $setting = $setting ?? null;
                @endphp

                <!-- Meta Title -->
                <div class="mt-4">
                    <label for="meta_title" class="block text-md font-medium text-gray-700 mb-1.5">
                        Meta Title
                    </label>
                    <input type="text" id="meta_title" name="meta_title" placeholder="Enter Meta Title"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700"
                        value="{{ old('meta_title', $setting->meta_title ?? '') }}">
                    @error('meta_title')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Meta Description -->
                <div class="mt-4">
                    <label for="meta_desc" class="block text-md font-medium text-gray-700 mb-1.5">
                        Meta Description
                    </label>
                    <textarea id="meta_desc" name="meta_desc" placeholder="Enter Meta Description"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700">{{ old('meta_desc', $setting->meta_desc ?? '') }}</textarea>
                    @error('meta_desc')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Meta Tag (JSON as comma-separated string) -->
                <div class="mt-4">
                    <label for="meta_tag" class="block text-md font-medium text-gray-700 mb-1.5">
                        Meta Tags (comma separated)
                    </label>
                    <input type="text" id="meta_tag" name="meta_tag" placeholder="tag1, tag2, tag3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-md focus:ring-1 focus:ring-blue-600 focus:outline-none text-gray-700"
                        value="{{ old('meta_tag', isset($setting->meta_tag) ? implode(',', $setting->meta_tag) : '') }}">
                    @error('meta_tag')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fav Icon -->
                <div class="mt-4">
                    <label for="fav_icon" class="block text-md font-medium text-gray-700 mb-1.5">
                        Favicon
                    </label>
                    <input type="file" id="fav_icon" name="fav_icon" class="w-full text-gray-700">
                    @if (isset($setting->fav_icon))
                        <img src="{{ asset($setting->fav_icon) }}" alt="Favicon" class="h-12 mt-2">
                    @endif
                    @error('fav_icon')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Side Logo -->
                <div class="mt-4">
                    <label for="side_logo" class="block text-md font-medium text-gray-700 mb-1.5">
                        Side Logo
                    </label>
                    <input type="file" id="side_logo" name="side_logo" class="w-full text-gray-700">
                    @if (isset($setting->side_logo))
                        <img src="{{ asset($setting->side_logo) }}" alt="Side Logo" class="h-12 mt-2">
                    @endif
                    @error('side_logo')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
