<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @php
        $favicon = $setting->fav_icon;
    @endphp
    @if ($favicon && file_exists(public_path($favicon)))
        <link rel="icon" href="{{ asset($favicon) }}" type="image/png">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script type="module" src="https://cdn.jsdelivr.net/npm/your-app/dist/app.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/your-app/dist/app.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('Roboto/Roboto-Regular.woff2') format('woff2');
            font-weight: 600;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .scrollhidden::-webkit-scrollbar {
            display: none;
        }

        .scrollhidden {
            scrollbar-width: none;
        }

        .scrollhidden {
            -ms-overflow-style: none;
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .submenu.open {
            max-height: 200px;
        }

        .active {
            background-color: #3b3f5c;
            color: #ffffff;
        }

        .scroll-bar::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-bar::-webkit-scrollbar-track {
            background: #2a2f45;
        }

        .scroll-bar::-webkit-scrollbar-thumb {
            background-color: #444c65;
            border-radius: 3px;
        }

        .scroll-bar {
            scrollbar-width: thin;
        }
    </style>
</head>
@include('error.error')

<body class="bg-white text-gray-200">
    <div class="flex flex-col h-screen relative">
        <!-- Header -->
        <div class="header w-full bg-[#2a2f45] z-10 flex items-center fixed top-0 left-0 right-0 print:hidden">
            <div class="md:h-[70px] h-[60px] w-full py-3 md:px-6 px-3 relative flex items-center">
                <div class="flex justify-between w-full items-center">
                    <div class="logo flex flex-row gap-16 hidden md:block">
                        <div class="flex flex-row gap-2 items-center">
                            <img src="{{ asset($setting->side_logo) }}" alt="Logo" class="w-44 h-auto" />
                        </div>
                    </div>
                    <i id="menuBtn" class="ri-menu-line md:hidden block text-white text-xl font-medium"></i>
                    <div class="flex flex-row items-center gap-5">
                        <div class="relative">
                            <div
                                class="absolute -right-1 -top-0 w-4 h-4 rounded-full bg-red-500 flex items-center justify-center">
                                <span class="text-white text-[10px] leading-none">2</span>
                            </div>
                            <i
                                class="ri-notification-2-line cursor-pointer text-white/80 hover:text-white text-[21px]"></i>
                        </div>
                        <i class="ri-moon-line text-white/80 cursor-pointer hover:text-white text-[21px]"></i>
                        <div id="profile_menu_btn" class="flex items-center flex-row gap-2 cursor-pointer">
                            <img src="{{ asset($setting->fav_icon) }}" alt="{{ auth()->guard('admin')->user()->name }}"
                                class="w-10 h-10 rounded-full">
                            <span class="text-white/80 text-[15px]">{{ auth()->guard('admin')->user()->name }}</span>
                            <i class="ri-arrow-down-s-line text-white/80"></i>
                        </div>
                        <i class="ri-settings-2-line cursor-pointer text-white/80 hover:text-white text-[21px]"></i>
                    </div>
                </div>
                <div id="profile_menu"
                    class="absolute top-full mt-0 right-0 w-60 bg-[#2a2f45] hidden rounded-b-lg overflow-hidden shadow-lg border border-gray-700">
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 transition duration-300 hover:bg-[#3b3f5c] group">
                        <i class="ri-user-line text-lg text-gray-400 group-hover:text-white"></i>
                        <span class="text-gray-300 group-hover:text-white">Profile</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-3 px-4 py-2 hover:bg-[#3b3f5c] group w-full text-left">
                            <i class="ri-logout-box-r-line text-lg text-gray-400 group-hover:text-white"></i>
                            <span class="text-gray-300 group-hover:text-white">Logout</span>
                        </button>
                    </form>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-[#3b3f5c] group">
                        <i class="ri-settings-3-line text-lg text-gray-400 group-hover:text-white"></i>
                        <span class="text-gray-300 group-hover:text-white">Site Setting</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="flex pt-[70px] print:p-0">
            <div id="sidebar"
                class="scroll-bar border-t border-gray-700 md:w-[230px] lg:w-[260px] z-50 md:block bg-[#2a2f45] fixed md:top-[70px] top-[60px] bottom-0 overflow-y-auto transition-all duration-500 ease-in-out transform -translate-x-full md:translate-x-0">
                <div class="pb-6 px-1.5 pt-1.5">
                    <ul>
                        <!-- Dashboard -->
                        <li class="group">
                            <a href="{{ route('admin.dashboard') }}"
                                class="mb-1 flex items-center pl-4 py-2.5 rounded
            {{ request()->routeIs('admin.dashboard') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                <i class="ri-dashboard-3-line mr-2 text-blue-400"></i>
                                <span class="text-[15px]">Dashboard & Overview</span>
                            </a>
                        </li>

                        <!-- Branch Management -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="branch">
                                <i class="ri-building-4-line mr-2 text-indigo-400"></i>
                                <span class="text-[15px]">Branch Management</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.branches.index') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.branches.index') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-list-unordered mr-2 text-gray-400"></i>All Branches
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.branches.create') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.branches.create') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-add-circle-line mr-2 text-green-400"></i>Add New Branch
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Student Management -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="student">
                                <i class="ri-user-3-line mr-2 text-yellow-400"></i>
                                <span class="text-[15px]">Student Management</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.students.index') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.students.index') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-file-list-3-line mr-2 text-gray-400"></i>All Students
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.students.create') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.students.create') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-user-add-line mr-2 text-green-400"></i>Add New Student
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Semester Management -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="semester">
                                <i class="ri-calendar-2-line mr-2 text-purple-400"></i>
                                <span class="text-[15px]">Semester Management</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.semesters.index') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.semesters.index') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-file-list-3-line mr-2 text-gray-400"></i>All Semesters
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.semesters.create') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.semesters.create') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-add-box-line mr-2 text-green-400"></i>Add Semester
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Course Management -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="course">
                                <i class="ri-book-2-line mr-2 text-orange-400"></i>
                                <span class="text-[15px]">Course Management</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.courses.index') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.courses.index') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-list-check mr-2 text-gray-400"></i>All Courses
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.courses.create') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                    {{ request()->routeIs('admin.courses.create') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:text-white hover:bg-[#3b3f5c]' }}">
                                        <i class="ri-add-circle-line mr-2 text-green-400"></i>Add Course
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Student Semester Management -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
        hover:bg-[#3b3f5c] rounded submenu-toggle transition-all duration-200"
                                data-menu-key="studentSemester">
                                <i class="ri-calendar-check-line mr-2 text-sky-400"></i>
                                <span class="text-[15px]">Student Semesters</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>

                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.students.semesters.index') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                {{ request()->routeIs('admin.students.semesters.index') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:bg-[#3b3f5c] hover:text-white transition' }}">
                                        <i class="ri-file-list-3-line mr-2 text-gray-400"></i>
                                        All Student Semesters
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.students.semesters.create') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded 
                {{ request()->routeIs('admin.students.semesters.create') ? 'bg-[#3b3f5c] text-white' : 'text-gray-300 hover:bg-[#3b3f5c] hover:text-white transition' }}">
                                        <i class="ri-add-circle-line mr-2 text-green-400"></i>
                                        Add Student Semester
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Student Grade/Marks -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="studentCourse">
                                <i class="ri-award-line mr-2 text-pink-400"></i>
                                <span class="text-[15px]">Student Grade/Marks</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.students.mark.index') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-file-list-3-line mr-2 text-gray-400"></i>All Student Marks
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.students.mark.create') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-add-box-line mr-2 text-green-400"></i>Add Student Marks
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Payment Request -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="payment">
                                <i class="ri-exchange-dollar-line mr-2 text-emerald-400"></i>
                                <span class="text-[15px]">Payment Request</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.payment.request.approved') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-check-double-line mr-2 text-green-400"></i>Approved
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.payment.request.pending') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-time-line mr-2 text-yellow-400"></i>Pending
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Pricing Management -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="pricing">
                                <i class="ri-money-dollar-circle-line mr-2 text-teal-400"></i>
                                <span class="text-[15px]">Pricing Management</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.pricing.index') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-list-check mr-2 text-gray-400"></i>All Pricing
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pricing.create') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-add-box-line mr-2 text-green-400"></i>Add Pricing
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Settings -->
                        <li class="group">
                            <a href="#"
                                class="mb-1 flex items-center pl-4 py-2.5 text-gray-300 hover:text-white 
            hover:bg-[#3b3f5c] rounded submenu-toggle"
                                data-menu-key="settings">
                                <i class="ri-settings-3-line mr-2 text-gray-400"></i>
                                <span class="text-[15px]">Advance Settings</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4"></i>
                            </a>
                            <ul class="submenu pl-2 bg-[#2a2f45]">
                                <li>
                                    <a href="{{ route('admin.account') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-user-settings-line mr-2 text-blue-400"></i>Account Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.settings.general') }}"
                                        class="flex items-center py-2 pl-6 text-[15px] rounded hover:bg-[#3b3f5c] hover:text-white transition">
                                        <i class="ri-global-line mr-2 text-purple-400"></i>General Settings
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div
            class="scrollhidden flex-1 md:ml-[230px] lg:ml-[260px] md:px-4 px-2 md:pt-4 overflow-y-auto print:p-0 print:m-0">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
    <script>
        document.getElementById("menuBtn").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("-translate-x-full");
        });

        profile_menu_btn.onclick = () => profile_menu.classList.toggle('hidden');

        document.addEventListener('DOMContentLoaded', function() {
            const submenuToggles = document.querySelectorAll('.submenu-toggle');
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    const submenuKey = this.dataset.menuKey;
                    if (submenu.classList.contains('open')) {
                        submenu.classList.remove('open');
                        submenu.style.maxHeight = '0';
                        this.classList.remove('bg-blue-500', 'text-white');
                        localStorage.removeItem('openMenu');
                    } else {
                        document.querySelectorAll('.submenu').forEach(sm => {
                            sm.classList.remove('open');
                            sm.style.maxHeight = '0';
                        });
                        document.querySelectorAll('.submenu-toggle').forEach(st => {
                            st.classList.remove('bg-blue-500', 'text-white');
                        });
                        submenu.classList.add('open');
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        this.classList.add('bg-blue-500', 'text-white');
                        localStorage.setItem('openMenu', submenuKey);
                    }
                });
            });

            const openMenuKey = localStorage.getItem('openMenu');
            if (openMenuKey) {
                const openToggle = document.querySelector(`[data-menu-key="${openMenuKey}"]`);
                if (openToggle) {
                    const submenu = openToggle.nextElementSibling;
                    submenu.classList.add('open');
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    openToggle.classList.add('bg-blue-500', 'text-white');
                }
            }
        });
    </script>
</body>

</html>
