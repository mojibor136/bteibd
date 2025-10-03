<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Login</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-200 bg-cover bg-center relative min-h-screen"
    style="background-image: url('{{ asset('image/mind.jpg') }}');">

    @include('error.error')

    <div class="absolute inset-0 bg-gray-800 bg-opacity-40"></div>
    <div class="flex items-center justify-center min-h-screen relative z-10 px-2">
        <div
            class="bg-white/30 border border-white/20 p-8 rounded-2xl shadow-xl w-full max-w-md text-gray-800 backdrop-blur-md backdrop-saturate-150">
            <h3 class="text-center text-3xl font-bold mb-6 flex items-center justify-center gap-2">
                <i class="ri-graduation-cap-line text-blue-500 text-4xl"></i>
                School Login
            </h3>

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold mb-1.5 text-gray-700">
                        <i class="ri-user-3-line mr-1"></i>Username
                    </label>
                    <input type="email" name="email" id="email" placeholder="Enter your email"
                        class="w-full text-md px-4 py-2.5 rounded-md bg-white/20 backdrop-blur-xl border
    @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-white/30 focus:border-blue-400 focus:ring-blue-400 @enderror
    text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1"
                        value="{{ old('email') }}" autocomplete="off" autocorrect="off" autocapitalize="off"
                        spellcheck="false">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold mb-1.5 text-gray-700">
                        <i class="ri-lock-2-line mr-1"></i>Password
                    </label>
                    <input type="password" name="password" id="password" placeholder="Enter your password"
                        class="w-full text-md px-4 py-2.5 rounded-md bg-white/20 backdrop-blur-xl border
    @error('password') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-white/30 focus:border-blue-400 focus:ring-blue-400 @enderror
    text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1"
                        autocomplete="new-password" autocorrect="off" autocapitalize="off" spellcheck="false">
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 transition-all duration-300 py-2.5 rounded-lg font-semibold text-white flex items-center justify-center gap-2">
                    <i class="ri-login-box-line text-lg"></i>Log In
                </button>
            </form>
        </div>
    </div>
</body>

</html>
