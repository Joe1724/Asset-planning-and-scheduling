@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12 bg-gray-100 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="p-10 bg-white shadow-xl rounded-xl">
            <div class="text-center">
                <h2 class="mb-2 text-3xl font-bold text-gray-900">Reset Password</h2>
                <p class="text-gray-600">Choose a new password for your account</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                           class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                           class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <button type="submit"
                            class="relative flex justify-center w-full px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-lg shadow-sm group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:shadow-md">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
