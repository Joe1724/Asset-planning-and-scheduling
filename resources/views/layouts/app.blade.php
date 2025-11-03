<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AssetEd - Professional Maintenance Management System">
    <title>AssetEd - Maintenance Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-gradient-primary {background: linear-gradient(to bottom, #030f42ff 0%, #02103aff 100%);}
        .shadow-modern { box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <nav class="text-white bg-gradient-primary shadow-modern">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold tracking-tight">AssetEd</a>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium">Welcome, {{ auth()->user()->name }}</span>
                        <span class="px-2 py-1 text-xs font-semibold text-indigo-100 bg-indigo-700 rounded-full">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center px-3 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="flex items-center p-4 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md shadow-sm">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center p-4 mb-6 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md shadow-sm">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-modern">
            @yield('content')
        </div>
    </main>

    <footer class="text-gray-300 bg-gray-800">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between md:flex-row">
                <div class="flex items-center mb-4 md:mb-0">
                    <span class="text-sm">&copy; 2025 AssetEd. All rights reserved.</span>
                </div>
                <div class="flex space-x-4">
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
