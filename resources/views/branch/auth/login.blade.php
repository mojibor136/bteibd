@extends('layouts.app')
@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-indigo-950 p-4">
        <div
            class="w-full max-w-md bg-gray-800 bg-opacity-80 backdrop-blur-sm p-8 rounded-2xl shadow-lg border border-gray-700">
            <h1 class="text-3xl font-bold text-center text-indigo-400 mb-4">Welcome Back</h1>
            <p class="text-center text-gray-400 mb-6">Sign in to continue</p>
            <form action="{{ route('branch.login.submit') }}" method="POST" autocomplete="off" class="space-y-4">
                @csrf
                <input type="text" name="username" style="display:none">
                <input type="password" name="password" style="display:none">

                <div>
                    <label class="text-gray-300 block mb-1">Email</label>
                    <input placeholder="you@example.com" name="username" autocomplete="off"
                        class="w-full px-4 py-3 rounded-lg border outline-none focus:ring-2 focus:ring-indigo-500 transition border-gray-700 bg-gray-900 text-gray-100"
                        type="email" value="">
                </div>
                <div class="relative">
                    <label class="text-gray-300 block mb-1">Password</label>
                    <input placeholder="***********" name="password" autocomplete="new-password"
                        class="w-full px-4 py-3 rounded-lg border outline-none focus:ring-2 focus:ring-indigo-500 transition border-gray-700 bg-gray-900 text-gray-100"
                        type="password" value="">
                </div>
                <button type="submit"
                    class="w-full py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white font-semibold transition">Sign
                    In</button>
            </form>
            <p class="mt-6 text-center text-gray-400 text-sm">
                Don't have an account?
                <a class="text-indigo-400 hover:underline" href="/register">Sign up</a>
            </p>
        </div>
    </div>
@endsection
