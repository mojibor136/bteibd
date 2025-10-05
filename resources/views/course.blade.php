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
                @foreach ($courses as $data)
                    <article
                        class="course-card bg-indigo-950 md:p-8 rounded-xl bg-opacity-88 backdrop-blur-sm border-4 border-gray-700 p-6 transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1 cursor-pointer"
                        onclick="openModal({{ $data->id }})">
                        <div class="p-2">
                            <h3 class="text-xl font-semibold text-white mb-2">{{ $data->name }}</h3>
                            <p class="text-gray-200 mb-4 line-clamp-2">{{ $data->description }}</p>
                            <p class="text-gray-200 mb-4 line-clamp-2 hidden">{{ $data->price }}</p>
                            <div class="flex items-center justify-between">
                                <button
                                    class="text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">Details</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Course Modal -->
    <div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-xl p-6 max-w-md w-full mx-4 text-left shadow-lg">
            <button onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>
            <div id="modalContent">
                <!-- Content injected dynamically -->
            </div>
        </div>
    </div>

    <script>
        // JSON data
        const courseData = @json($courses);

        const courseModal = document.getElementById('courseModal');
        const modalContent = document.getElementById('modalContent');

        function openModal(id) {
            const course = courseData.find(c => c.id === id);

            // Modal content inject (name, description, price)
            modalContent.innerHTML = `
            <h2 class="text-2xl font-bold text-gray-800 mb-2">${course.name}</h2>
            <p class="text-gray-700 mb-2">${course.description}</p>
            <p class="text-gray-900 font-semibold text-lg">Price: $${course.price}</p>
        `;

            // Show modal
            courseModal.classList.remove('hidden');

            // Animation
            setTimeout(() => {
                courseModal.children[0].classList.remove('scale-90', 'opacity-0');
                courseModal.children[0].classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            // Animation hide
            courseModal.children[0].classList.remove('scale-100', 'opacity-100');
            courseModal.children[0].classList.add('scale-90', 'opacity-0');

            setTimeout(() => {
                courseModal.classList.add('hidden');
            }, 300);
        }

        // Course search filter
        const searchInput = document.getElementById('searchInput');
        const courseCards = document.querySelectorAll('.course-card');

        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            courseCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                card.style.display = title.includes(query) ? '' : 'none';
            });
        });
    </script>
@endsection
