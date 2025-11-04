@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12 bg-gray-100 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="p-10 bg-white shadow-xl rounded-xl">
            <div class="text-center">
                <h2 class="mb-2 text-3xl font-bold text-gray-900">Forgot Password</h2>
                <p class="text-gray-600">Enter your email to reset your password</p>
            </div>

            @if (session('status'))
                <div class="p-4 mt-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <button type="submit"
                            class="relative flex justify-center w-full px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-lg shadow-sm group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:shadow-md">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
