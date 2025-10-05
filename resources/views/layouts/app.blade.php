<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @php
        $favicon = $setting->fav_icon;
    @endphp
    @if ($favicon && file_exists(public_path($favicon)))
        <link rel="icon" href="{{ asset($favicon) }}" type="image/png">
    @endif
    <title>{{ $setting->meta_title ?? 'Bangladesh Technical Education Institute' }}</title>
    @if (!empty($setting->meta_desc))
        <meta name="description" content="{{ $setting->meta_desc }}">
    @endif
    @if (!empty($setting->meta_tag) && is_array($setting->meta_tag))
        <meta name="keywords" content="{{ implode(', ', $setting->meta_tag) }}">
    @endif
</head>

<body>
    @include('error.error')

    <div class="bg-gray-800 px-2 py-1 flex justify-between items-center print:hidden">
        <div class="flex gap-2 items-center">
            <span class="text-white text-sm">📞 +880 1234 567890</span>
            <span class="text-white text-md">✉️ bteibd@gmail.com</span>
        </div>
        <span class="text-white text-sm">27 Sept 2025</span>
    </div>

    <div id="header-wrapper" class="relative z-50 print:hidden">
        <div id="header"
            class="flex justify-between items-center px-4 py-2 bg-white shadow-md transition-all duration-300">
            <div class="flex gap-2 items-center">
                <img src="https://i.ibb.co.com/Pv2JsgX1/d1c5d611-d237-463b-b186-5adab2a4e7f3.jpg" alt=""
                    class="w-16 h-16 rounded-full object-cover">
                <div class="flex flex-col gap-1">
                    <span class="md:text-xl text-lg font-bold text-gray-800">Bangladesh Technical</span>
                    <span class="md:text-md text-sm text-gray-600 -mt-1">Education Institute</span>
                </div>
            </div>

            <button id="menu-toggle"
                class="lg:hidden flex flex-col justify-center items-center w-10 h-10 rounded focus:outline-none">
                <span class="block w-6 h-0.5 bg-gray-800 mb-1.5"></span>
                <span class="block w-6 h-0.5 bg-gray-800 mb-1.5"></span>
                <span class="block w-6 h-0.5 bg-gray-800"></span>
            </button>

            <nav id="main-nav"
                class="hidden lg:flex items-center absolute lg:static top-full left-0 w-full lg:w-auto bg-white lg:bg-transparent shadow-lg lg:shadow-none z-20 flex-col lg:flex-row lg:p-0">
                <div class="flex flex-col items-start lg:flex-row lg:items-center w-full">
                    <a href="{{ route('home') }}"
                        class="text-gray-800 hover:text-blue-600 font-medium px-4 py-2 hover:bg-gray-100 rounded text-md w-full lg:w-auto">Home</a>
                    <a href="{{ route('course') }}"
                        class="text-gray-800 hover:text-blue-600 font-medium px-4 py-2 hover:bg-gray-100 rounded text-md w-full lg:w-auto">Course
                        List</a>
                    <a href="{{ route('branch') }}"
                        class="text-gray-800 hover:text-blue-600 font-medium px-4 py-2 hover:bg-gray-100 rounded text-md w-full lg:w-auto">Verified
                        Institutes</a>
                    <a href="{{ route('result') }}"
                        class="text-gray-800 hover:text-blue-600 font-medium px-4 py-2 hover:bg-gray-100 rounded text-md w-full lg:w-auto">Student
                        Result</a>
                    <div
                        class="flex flex-col gap-2 mt-4 mb-4 md:mb-0 lg:mt-0 ml-0 lg:ml-4 lg:flex-row w-full lg:w-auto md:px-0 px-4">
                        @guest
                            <button onclick="window.location.href='{{ route('branch.login') }}'"
                                class="bg-gray-100 text-gray-800 border border-gray-200 text-md px-4 py-2 rounded hover:bg-gray-300 font-medium transition w-full lg:w-auto">
                                Login
                            </button>
                            <button onclick="window.location.href='{{ route('branch.register') }}'"
                                class="bg-gray-100 text-gray-800 border border-gray-200 text-md px-4 py-2 rounded hover:bg-gray-300 font-medium transition w-full lg:w-auto">
                                Register
                            </button>
                        @endguest

                        @auth
                            <button onclick="window.location.href='{{ route('branch.dashboard') }}'"
                                class="bg-gray-100 text-gray-800 border border-gray-200 text-md px-4 py-2 rounded hover:bg-gray-300 font-medium transition w-full lg:w-auto">
                                Dashboard
                            </button>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <script>
        const header = document.getElementById('header');
        const headerWrapper = document.getElementById('header-wrapper');
        const headerHeight = header.offsetHeight;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 0) {
                header.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'shadow-xl');
                headerWrapper.style.height = `${headerHeight}px`;
            } else {
                header.classList.remove('fixed', 'top-0', 'left-0', 'right-0', 'shadow-xl');
                headerWrapper.style.height = `auto`;
            }
        });
    </script>

    @yield('content')

    <footer class="print:hidden bg-gradient-to-br from-gray-950 via-gray-900 to-indigo-950 text-gray-300">
        <div class="container mx-auto px-4 py-8">

            <!-- Footer Top Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-8 border-b border-gray-700">

                <!-- Logo & Description -->
                <div class="flex flex-col items-center sm:items-start text-center sm:text-left">
                    <div class="flex items-center mb-4">
                        <img alt="Logo-04" class="h-20 w-25 rounded-full"
                            src="https://i.ibb.co.com/60FCJscH/Logo-04.png">
                        <div class="ml-3">
                            <h3 class="text-gray-100 text-base sm:text-xl font-bold">BANGLADESH TECHNICAL</h3>
                            <h3 class="text-gray-100 text-base sm:text-xl font-bold">EDUCATION INSTITUTE</h3>
                        </div>
                    </div>
                    <p class="max-w-xs text-sm mb-4">
                        "A diploma from our institute is more than just qualification; it's a foundation for a
                        successful career and a fulfilling life."
                    </p>

                    <!-- Social Links -->
                    <div class="flex space-x-4 text-gray-400">
                        <a href="#" class="hover:text-pink-400 transition-colors"><i
                                class="ri-facebook-fill"></i></a>
                        <a href="#" class="hover:text-pink-400 transition-colors"><i
                                class="ri-twitter-fill"></i></a>
                        <a href="#" class="hover:text-pink-400 transition-colors"><i
                                class="ri-linkedin-fill"></i></a>
                        <a href="#" class="hover:text-pink-400 transition-colors"><i
                                class="ri-instagram-fill"></i></a>
                    </div>
                </div>

                <!-- Useful Links -->
                <div class="mt-4 sm:mt-8">
                    <h4 class="text-gray-100 text-lg font-bold uppercase mb-2">Useful Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="flex items-center hover:text-indigo-400 transition-colors"><span
                                    class="mr-2 text-xs">&gt;</span>Home</a></li>
                        <li><a href="#" class="flex items-center hover:text-indigo-400 transition-colors"><span
                                    class="mr-2 text-xs">&gt;</span>About Us</a></li>
                        <li><a href="#" class="flex items-center hover:text-indigo-400 transition-colors"><span
                                    class="mr-2 text-xs">&gt;</span>Branch</a></li>
                        <li><a href="#" class="flex items-center hover:text-indigo-400 transition-colors"><span
                                    class="mr-2 text-xs">&gt;</span>Privacy</a></li>
                        <li><a href="/ContactForm"
                                class="flex items-center hover:text-indigo-400 transition-colors"><span
                                    class="mr-2 text-xs">&gt;</span>Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="mt-4 sm:mt-8">
                    <h4 class="text-gray-100 text-lg font-bold uppercase mb-2">Contact Info</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start"><span class="mr-2 mt-1">📍</span>Website: www.bteibd.com</li>
                        <li class="flex items-start"><span class="mr-2 mt-1">📞</span>Mobile: +880 1866-764908</li>
                        <li class="flex items-start"><span class="mr-2 mt-1">✉️</span>Email: bteibu@gmail.com</li>
                        <li class="flex items-start"><span class="mr-2 mt-1">🏢</span>Head Office: Bandar, Sonargaon,
                            Narayanganj</li>
                    </ul>
                </div>

                <!-- Prayer Timing Card -->
                <div class="mt-4 sm:mt-8 flex flex-col items-center lg:items-end relative">
                    <div
                        class="bg-gray-800 bg-opacity-80 backdrop-blur-sm p-6 rounded-lg text-center shadow-lg w-full md:max-w-[280px]">
                        <p class="italic text-gray-400 text-sm">
                            "Prayer is the key to Jannah, <br> let us all stay devoted to it."
                        </p>
                        <p class="mt-2 text-gray-100 bg-indigo-600 rounded-xl px-3 py-1 text-center font-bold text-sm">
                            নামাজের সময় সূচি</p>
                        <ul class="mt-4 space-y-2 text-gray-200 text-sm w-full">
                            <li class="flex justify-between items-center border-b border-gray-700 pb-1"><span
                                    class="text-gray-100 font-semibold">Fajr</span><span
                                    class="text-indigo-400 font-bold">04:35 AM</span></li>
                            <li class="flex justify-between items-center border-b border-gray-700 pb-1"><span
                                    class="text-gray-100 font-semibold">Dhuhr</span><span
                                    class="text-indigo-400 font-bold">11:48 AM</span></li>
                            <li class="flex justify-between items-center border-b border-gray-700 pb-1"><span
                                    class="text-gray-100 font-semibold">Asr</span><span
                                    class="text-indigo-400 font-bold">03:12 PM</span></li>
                            <li class="flex justify-between items-center border-b border-gray-700 pb-1"><span
                                    class="text-gray-100 font-semibold">Maghrib</span><span
                                    class="text-indigo-400 font-bold">05:46 PM</span></li>
                            <li class="flex justify-between items-center"><span
                                    class="text-gray-100 font-semibold">Isha</span><span
                                    class="text-indigo-400 font-bold">07:01 PM</span></li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="flex flex-col sm:flex-row justify-between items-center pt-4 text-sm">
                <p class="text-gray-400 mb-2 sm:mb-0 text-center sm:text-left">&copy; 2025 Bangladesh Technical
                    Education Institute</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Contact Us</a>
                </div>
            </div>

        </div>
    </footer>

    <script>
        const cards = document.querySelectorAll('#card-slider > div');

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        cards.forEach(card => {
            card.style.backgroundColor = getRandomColor();
        });
    </script>


    <style>
        #card-slider {
            display: flex;
            animation: slide 20s linear infinite;
        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>

    <script>
        const slider = document.getElementById('card-slider');
        const cards = slider.innerHTML;
        slider.innerHTML += cards;
    </script>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mainNav = document.getElementById('main-nav');
        menuToggle.addEventListener('click', () => {
            mainNav.classList.toggle('hidden');
        });
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !mainNav.contains(e.target) && window.innerWidth < 1024) {
                mainNav.classList.add('hidden');
            }
        });
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                mainNav.classList.remove('hidden');
            } else {
                mainNav.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
