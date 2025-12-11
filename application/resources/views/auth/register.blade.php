@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto mt-12 space-y-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200 border-l-4 border-green-300 hover:shadow transition">
        @csrf
        <h1 class="text-2xl font-bold">Register</h1>
        <p class="text-sm text-gray-500">Create a new account to start sending and receiving funds.</p>

        <div>
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="mt-1 w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-200" required>
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="mt-1 w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-200" required>
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-200" required>
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="mt-1 w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-200" required>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Register</button>

        <p class="text-sm text-gray-600 mt-4 text-center">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-medium">Login</a>
        </p>
    </form>
@endsection
