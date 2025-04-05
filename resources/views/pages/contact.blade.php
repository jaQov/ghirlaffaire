@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    {{-- Success message --}}
    @if(session('success'))
    <div class="mb-6 p-4 text-green-800 bg-green-100 dark:bg-green-900 dark:text-green-200 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-3xl font-bold mb-6 text-center">Contact Us</h1>

    <form method="POST" action="{{ route('contact.store') }}"
        class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-green-500 focus:border-green-500">
            @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-green-500 focus:border-green-500">
            @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone
                (optional)</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-green-500 focus:border-green-500">
            @error('phone')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Message --}}
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
            <textarea name="message" id="message" rows="5" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-green-500 focus:border-green-500">{{ old('message') }}</textarea>
            @error('message')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="text-center">
            <button type="submit"
                class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                Send Message
            </button>
        </div>
    </form>
</div>
@endsection