@extends('branch.layouts.app')
@section('title', 'Payment Request')

@section('content')
    @include('error.error')

    <div class="w-full flex flex-col gap-4 mb-20">
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Create Payment</h2>
                <a href="{{ route('branch.payment.approved') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Payments
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('branch.dashboard') }}" class="text-blue-600 hover:underline">Home</a> / Payment /
                    Create
                </p>
                <a href="{{ route('branch.payment.approved') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Payments
                </a>
            </div>
        </div>

        <div class="w-full bg-white rounded shadow px-6 py-6">
            <form action="{{ route('branch.payment.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
                @csrf

                <!-- student_reg -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Student Registration No</label>
                    <input type="text" name="student_reg" placeholder="Enter Student Registration No"
                        value="{{ old('student_reg') }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <!-- amount -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Amount</label>
                    <input type="number" name="amount" placeholder="Enter Amount" value="{{ old('amount') }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <!-- method -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Payment Method</label>
                    <select name="method"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="">Select Method</option>
                        <option value="bkash" {{ old('method') == 'bkash' ? 'selected' : '' }}>Bkash</option>
                        <option value="nagad" {{ old('method') == 'nagad' ? 'selected' : '' }}>Nagad</option>
                        <option value="rocket" {{ old('method') == 'rocket' ? 'selected' : '' }}>Rocket</option>
                        <option value="bank" {{ old('method') == 'bank' ? 'selected' : '' }}>Bank</option>
                    </select>
                </div>

                <!-- number -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-md text-gray-700 mb-1 font-medium">Account / Transaction Number</label>
                    <input type="text" name="number" placeholder="Enter Account or Transaction Number"
                        value="{{ old('number') }}"
                        class="w-full text-gray-700 rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div class="col-span-2 mt-2">
                    <button type="submit"
                        class="w-full rounded-md bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 text-sm sm:text-base transition-all duration-200">
                        Create Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
