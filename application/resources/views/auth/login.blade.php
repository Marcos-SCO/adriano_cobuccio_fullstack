@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto mt-20 space-y-4">
        @csrf
        <h1 class="text-2xl font-bold">Login</h1>

        <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="mt-1 w-full rounded border-gray-300" required autofocus>
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 w-full rounded border-gray-300" required>
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>

        <p class="text-sm text-gray-600 mt-4">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600">Register</a>
        </p>
    </form>
@endsection
