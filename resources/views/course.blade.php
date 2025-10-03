@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gray-100">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20">

            <form class="flex justify-center mb-10">
                <input id="searchInput" type="text" placeholder="Search courses..."
                    class="w-full sm:w-1/2 px-4 py-2 border border-gray-500 shadow-sm rounded-lg focus:ring-2 focus:outline-none">
            </form>

            <h2 class="text-3xl font-playfair font-bold text-black mb-10 text-center">Course List</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <article 
                    class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="p-2">
                        <h3 class="text-xl font-semibold text-white mb-2">Basic Computer Fundamentals</h3>
                        <p class="text-gray-200 mb-4 line-clamp-2">Easy way to learn computer fundamentals.</p>
                        <div class="flex items-center justify-between">
                            <button
                                class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                        </div>
                    </div>
                </article>

                <article
                    class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="p-2">
                        <h3 class="text-xl font-semibold text-white mb-2">Microsoft Office (Word, Excel, PowerPoint)</h3>
                        <p class="text-gray-200 mb-4 line-clamp-2">Easy way to master Office apps.</p>
                        <div class="flex items-center justify-between">
                            <button
                                class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                        </div>
                    </div>
                </article>

                <article
                    class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="p-2">
                        <h3 class="text-xl font-semibold text-white mb-2">Graphic Design</h3>
                        <p class="text-gray-200 mb-4 line-clamp-2">Learn graphic design easily.</p>
                        <div class="flex items-center justify-between">
                            <button
                                class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                        </div>
                    </div>
                </article>

                <article
                    class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="p-2">
                        <h3 class="text-xl font-semibold text-white mb-2">Computer Office Application</h3>
                        <p class="text-gray-200 mb-4 line-clamp-2">Easy way to use office software.</p>
                        <div class="flex items-center justify-between">
                            <button
                                class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                        </div>
                    </div>
                </article>

                <article
                    class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="p-2">
                        <h3 class="text-xl font-semibold text-white mb-2">Web Design & Development</h3>
                        <p class="text-gray-200 mb-4 line-clamp-2">Learn to design and develop websites.</p>
                        <div class="flex items-center justify-between">
                            <button
                                class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                        </div>
                    </div>
                </article>

                <article
                    class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="p-2">
                        <h3 class="text-xl font-semibold text-white mb-2">Computer Hardware & Networking</h3>
                        <p class="text-gray-200 mb-4 line-clamp-2">Easy way to learn hardware and networking.</p>
                        <div class="flex items-center justify-between">
                            <button
                                class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                        </div>
                    </div>
                </article>

                <article
                    class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                    <div class="p-2">
                        <h3 class="text-xl font-semibold text-white mb-2">Mobile App Development</h3>
                        <p class="text-gray-200 mb-4 line-clamp-2">Learn mobile app development easily.</p>
                        <div class="flex items-center justify-between">
                            <button
                                class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const courseCards = document.querySelectorAll('.course-card');

        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            courseCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                if (title.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection
