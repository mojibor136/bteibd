@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="text-3xl font-bold text-black text-center mb-10">Branches List</div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto px-4">
            <div
                class="branch-card bg-gradient-to-br from-gray-950 via-gray-900 to-indigo-950 p-4 rounded-xl bg-opacity-88 backdrop-blur-sm transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                <div class="rounded-xl bg-opacity-80 backdrop-blur-sm p-4 text-center">
                    <img class="w-24 h-24 rounded-2xl object-cover mb-4 border-2 border-indigo-500 mx-auto"
                        src="https://i.ibb.co/wFG4FFVW/1000518045.jpg" alt="Asif Al Hasan">
                    <h2 class="text-2xl font-bold text-emerald-200 mb-2">Asif Al Hasan</h2>
                    <p class="text-white mb-1">Skill Technical Training Centre</p>
                </div>
                <div class="">
                    <div class="mt-4 border-t border-gray-700 pt-4 space-y-2">
                        <div class="flex gap-2">
                            <span class="text-white font-medium">Address:</span>
                            <span class="text-white">Savar, Radio Colony</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-white font-medium">Branch ID:</span>
                            <span class="text-white">12345</span>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <button
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-full transition-colors duration-200">Details</button>
                    </div>
                </div>
            </div>

            @for ($i = 0; $i < 8; $i++)
                <div
                    class="branch-card bg-gradient-to-br from-gray-950 via-gray-900 to-indigo-950 p-4 rounded-xl bg-opacity-88 backdrop-blur-sm transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="rounded-xl bg-opacity-80 backdrop-blur-sm p-4 text-center">
                        <img class="w-24 h-24 rounded-2xl object-cover mb-4 border-2 border-indigo-500 mx-auto"
                            src="https://i.ibb.co/wFG4FFVW/1000518045.jpg" alt="Branch Image">
                        <h2 class="text-2xl font-bold text-emerald-200 mb-2">Branch Name</h2>
                        <p class="text-white mb-1">Branch Description</p>
                    </div>
                    <div class="">
                        <div class="mt-4 border-t border-gray-700 pt-4 space-y-2">
                            <div class="flex gap-2">
                                <span class="text-white font-medium">Address:</span>
                                <span class="text-white">Savar, Radio Colony</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-white font-medium">Branch ID:</span>
                                <span class="text-white">12345</span>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-center">
                            <button
                                class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-full transition-colors duration-200">Details</button>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
