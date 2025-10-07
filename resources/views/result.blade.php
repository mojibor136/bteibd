@extends('layouts.app')
@section('content')
    <style>
        @media print {
            @page {
                margin: 20mm;
                size: auto;
            }

            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
        }
    </style>

    <div class="max-w-6xl mx-auto my-8 p-1 lg:p-6 shadow-xl rounded-lg border border-gray-200 print:p-0 print:border-none"
        style="opacity: 1; transform: none;">
        <div class="mb-6 print:hidden" style="opacity: 1; transform: none;">
            <label for="studentId" class="block text-sm sm:text-xl text-black mb-2 font-extrabold">
                Enter Student Roll
            </label>
            <form id="studentForm" action="{{ route('student.search') }}" method="get">
                <input id="studentId" placeholder="e.g., 750279" name="studentId"
                    class="w-full px-4 py-2 rounded bg-gray-50 border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base"
                    type="text" />
            </form>
        </div>
        <p class="text-center print:hidden text-gray-500 mt-6" style="opacity: 1;">
            Enter a student ID to view their details.
        </p>

        <div id="resultContainer" class="hidden w-full">

        </div>
    </div>
    <script>
        const form = document.getElementById('studentForm');
        const input = document.getElementById('studentId');
        const resultContainer = document.getElementById('resultContainer');
        let timeout;

        input.addEventListener('input', () => {
            const value = input.value.trim();
            if (value.length < 6) {
                clearTimeout(timeout);
                resultContainer.classList.add('hidden');
                return;
            }
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetch("{{ route('student.search') }}?studentId=" + value)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            resultContainer.innerHTML = `
 <div class="container mt-6 print:m-0 w-full" style="opacity: 1; transform: none;">
                <header
                    class="bg-white flex items-center justify-between px-2 sm:px-6 py-4 shadow-sm border-b border-t border-gray-50 print:bg-transparent print:border-none">
                    <div class="flex-shrink-0 flex items-center">
                        <img alt="Seal of Bangladesh" class="w-40 h-46 object-cover p-1" loading="lazy"
                            src="https://bteibd.com/assets/logo-removebg-preview-SVkDwn_u.png" />
                    </div>

                    <div class="flex-1 text-center text-gray-900 min-w-0">
                        <p class="text-[10px] sm:text-base leading-tight font-medium">
                            Government of the People's Republic of Bangladesh
                        </p>
                        <h1 class="text-base sm:text-3xl font-bold leading-tight mt-1">
                            Bangladesh Technical Education Institute
                        </h1>

                        <div class="flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-4 text-xs mt-1">
                            <p class="leading-tight text-[18px] sm:text-xs">
                                Website: <a href="https://bteibd.com" class="text-gray-600 underline">https://bteibd.com</a>
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-center items-center gap-1 sm:gap-4 text-xs mt-1">
                            <p class="leading-tight text-[10px] sm:text-xs">
                                Govt. Reg No:
                            </p>
                        </div>
                    </div>

                    <div class="flex-shrink-0 flex items-center">
                        <div class="flex justify-center items-start pt-2 md:pt-8">
                            <img alt="Student"
                                class="w-19 h-22 sm:w-41 sm:h-48 object-cover border border-gray-300 p-1 bg-white"
                                src="/${data.student.profile_photo}" />
                        </div>
                    </div>
                </header>

                <table class="w-full border border-gray-200 overflow-hidden mb-6">
                    <tbody>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200 text-left">Name of
                                Student
                            </td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.name}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Father's Name</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.father_name}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Mother's Name</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.mother_name}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Date of Birth</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.date_of_birth}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Institute Name</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.institute_name}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Roll</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.roll}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Registration No</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.registration_no}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Student Type</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.student_type}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Course Duration</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.course_duration}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Session</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.session}</td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">Course Name</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.course_name}
                            </td>
                        </tr>
                        <tr class="odd:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-700 border border-gray-200">CGPA Result</td>
                            <td class="px-4 py-2 text-gray-900 border border-gray-200">${data.student.cgpa_result}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="w-full border border-gray-200 overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th colspan="7"
                                class="p-3 text-center text-sm sm:text-2xl font-semibold uppercase tracking-wide text-gray-700 border-b border-gray-300">
                                Semester Wise Results
                            </th>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold border border-gray-200">Semester
                            </th>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold border border-gray-200">Grade
                            </th>
                            <th class="px-4 py-2 text-left text-gray-700 font-semibold border border-gray-200">Grade
                                Point
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">1st Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A</td>
                            <td class="px-4 py-2 border border-gray-200">3.79</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">2nd Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A</td>
                            <td class="px-4 py-2 border border-gray-200">3.75</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">3rd Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A</td>
                            <td class="px-4 py-2 border border-gray-200">3.70</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">4th Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A</td>
                            <td class="px-4 py-2 border border-gray-200">3.75</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">5th Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A</td>
                            <td class="px-4 py-2 border border-gray-200">3.75</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">6th Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A-</td>
                            <td class="px-4 py-2 border border-gray-200">3.70</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">7th Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A</td>
                            <td class="px-4 py-2 border border-gray-200">3.75</td>
                        </tr>
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-200">8th Semester</td>
                            <td class="px-4 py-2 border border-gray-200">A+</td>
                            <td class="px-4 py-2 border border-gray-200">4.00</td>
                        </tr>
                    </tbody>
                </table>

                <table class="min-w-full border border-gray-300 mt-6 overflow-hidden shadow-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th colspan="7"
                                class="p-3 text-center text-sm sm:text-2xl font-semibold uppercase tracking-wide text-gray-700 border-b border-gray-300">
                                Course Wise Grade / Marks
                            </th>
                        </tr>
                        <tr class="bg-gray-100">
                            <th
                                class="text-center font-semibold text-gray-700 uppercase border border-gray-300 px-2 py-2 text-[11px] sm:text-sm">
                                Written</th>
                            <th
                                class="text-center font-semibold text-gray-700 uppercase border border-gray-300 px-2 py-2 text-[11px] sm:text-sm">
                                Practical</th>
                            <th
                                class="text-center font-semibold text-gray-700 uppercase border border-gray-300 px-2 py-2 text-[11px] sm:text-sm">
                                Viva</th>
                            <th
                                class="text-center font-semibold text-gray-700 uppercase border border-gray-300 px-2 py-2 text-[11px] sm:text-sm">
                                Total</th>
                            <th
                                class="text-center font-semibold text-gray-700 uppercase border border-gray-300 px-2 py-2 text-[11px] sm:text-sm">
                                Full Mark</th>
                            <th
                                class="text-center font-semibold text-gray-700 uppercase border border-gray-300 px-2 py-2 text-[11px] sm:text-sm">
                                CGPA</th>
                            <th
                                class="text-center font-semibold text-gray-700 uppercase border border-gray-300 px-2 py-2 text-[11px] sm:text-sm">
                                Grade</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td
                                class="w-1/7 text-center text-gray-900 border border-gray-300 px-2 py-2 text-xs sm:text-base">
                                3200</td>
                            <td
                                class="w-1/7 text-center text-gray-900 border border-gray-300 px-2 py-2 text-xs sm:text-base">
                                260</td>
                            <td
                                class="w-1/7 text-center text-gray-900 border border-gray-300 px-2 py-2 text-xs sm:text-base">
                                250</td>
                            <td
                                class="w-1/7 text-center text-gray-900 border border-gray-300 px-2 py-2 text-xs sm:text-base">
                                3710</td>
                            <td
                                class="w-1/7 text-center text-gray-900 border border-gray-300 px-2 py-2 text-xs sm:text-base">
                                4800</td>
                            <td
                                class="w-1/7 text-center text-gray-900 border border-gray-300 px-2 py-2 text-xs sm:text-base">
                                3.75</td>
                            <td
                                class="w-1/7 text-center text-gray-900 border border-gray-300 px-2 py-2 text-xs sm:text-base">
                                A
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-6 flex justify-center items-center">
                    <button onclick="window.print()"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-medium transition text-sm sm:text-base">
                        Download Result
                    </button>
                </div>
            </div>
                `;
                            resultContainer.classList.remove('hidden');
                            resultContainer.style.display = 'block';
                        } else {
                            resultContainer.innerHTML = `<p>${data.message}</p>`;
                            resultContainer.classList.remove('hidden');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        resultContainer.innerHTML = `<p>Error occurred</p>`;
                        resultContainer.classList.remove('hidden');
                    });
            }, 1000); // 1 second debounce
        });
    </script>
@endsection
