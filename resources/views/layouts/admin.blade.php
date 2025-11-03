<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 text-white shadow-xl bg-gradient-to-b from-slate-900 to-slate-800">
            <div class="p-6 border-b border-slate-700">
                <div class="flex items-center space-x-3">
                    <div>
                        <h2 class="text-xl font-bold">AssetEd</h2>
                        <p class="text-sm text-slate-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="px-3 mt-6">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.users') }}"
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <span class="font-medium">Users</span>
                </a>

                <a href="{{ route('admin.locations') }}"
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.locations') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <span class="font-medium">Locations</span>
                </a>

                <a href="{{ route('admin.assets') }}"
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.assets') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <span class="font-medium">Assets</span>
                </a>

                <a href="{{ route('admin.requests') }}"
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.requests') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <span class="font-medium">Requests</span>
                </a>

                <a href="{{ route('admin.work-orders') }}"
                   class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.work-orders') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <span class="font-medium">Work Orders</span>
                </a>

                <div class="pt-6 mt-8 border-t border-slate-600">
                    <a href="{{ route('logout') }}"
                       class="flex items-center px-4 py-3 text-red-400 transition-all duration-200 rounded-lg hover:bg-red-600 hover:text-white"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="font-medium">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <header class="bg-white border-b shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">
                        @yield('title', 'Admin Panel')
                    </h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Welcome, {{ auth()->user()->name }}</span>
                        <span class="px-2 py-1 text-xs text-red-800 bg-red-100 rounded-full">Admin</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
