@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto mt-12 space-y-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200 border-l-4 border-green-300 hover:shadow transition">
        @csrf
        <h1 class="text-2xl font-bold">Register</h1>
        <p class="text-sm text-gray-500">Create a new account to start sending and receiving funds.</p>

        <x-form-input label="Name" name="name" :value="old('name')" required />

        <x-form-input label="Email" name="email" type="email" :value="old('email')" required />

        <x-form-input label="Password" name="password" type="password" required />

        <x-form-input label="Confirm Password" name="password_confirmation" type="password" required />

        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Register</button>

        <p class="text-sm text-gray-600 mt-4 text-center">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-medium">Login</a>
        </p>
    </form>
@endsection
