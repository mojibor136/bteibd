@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="text-3xl font-bold text-black text-center mb-10">Branches List</div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto px-4">
            @foreach ($user as $data)
                <div
                    class="branch-card bg-gradient-to-br from-gray-950 via-gray-900 to-indigo-950 p-4 rounded-xl bg-opacity-88 backdrop-blur-sm transition-all duration-500 hover:shadow-2xl hover:scale-105 hover:-translate-y-1 cursor-pointer">
                    <div class="rounded-xl bg-opacity-80 backdrop-blur-sm p-4 text-center">
                        <img class="w-24 h-24 rounded-2xl object-cover mb-4 border-2 border-indigo-500 mx-auto"
                            src="{{ asset($data->director_photo) }}" alt="{{ $data->director_name }}">
                        <h2 class="text-2xl font-bold text-emerald-200 mb-2">{{ $data->director_name }}</h2>
                        <p class="text-white mb-1">{{ $data->institute_name }}</p>
                    </div>
                    <div class="mt-4 border-t border-gray-700 pt-4 space-y-2">
                        <div class="flex gap-2">
                            <span class="text-white font-medium">Address:</span>
                            <span class="text-white">{{ $data->address }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="text-white font-medium">Branch ID:</span>
                            <span class="text-white">{{ $data->id }}</span>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-center">
                        <button onclick="openModal({{ $data->id }})"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-full transition-colors duration-200">Details</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="branchModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 relative">
            <button onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>
            <div id="modalContent" class="text-center">
            </div>
        </div>
    </div>

    <script>
        const branchData = @json($user);

        function openModal(id) {
            const branch = branchData.find(b => b.id === id);
            const modal = document.getElementById('branchModal');
            const content = document.getElementById('modalContent');

            content.innerHTML = `
            <img class="w-32 h-32 rounded-full mx-auto mb-4 border-2 border-indigo-500" src="${branch.director_photo}" alt="${branch.director_name}">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">${branch.director_name}</h2>
            <p class="text-gray-700 mb-1">${branch.institute_name}</p>
            <p class="text-gray-600 mb-1">Address: ${branch.address}</p>
            <p class="text-gray-600 mb-1">Branch ID: ${branch.id}</p>
        `;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('branchModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection
