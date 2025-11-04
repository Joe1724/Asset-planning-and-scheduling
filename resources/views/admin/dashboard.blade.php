@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">
            Admin Dashboard
        </h1>
        <p class="text-gray-600">Welcome back! Here's your system overview.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <div class="relative p-6 overflow-hidden bg-white border-l-4 border-blue-900 shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium tracking-wide text-gray-500 uppercase">Total Users</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    <p class="mt-1 text-sm text-green-600">
                        +12% from last month
                    </p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-full">
                    <i class="text-2xl text-indigo-600 fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="relative p-6 overflow-hidden bg-white border-l-4 border-blue-900 shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium tracking-wide text-gray-500 uppercase">Total Assets</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_assets'] }}</p>
                    <p class="mt-1 text-sm text-green-600">
                        +8% from last month
                    </p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="text-2xl text-green-600 fas fa-cogs"></i>
                </div>
            </div>
        </div>

        <div class="relative p-6 overflow-hidden bg-white border-l-4 border-blue-900 shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium tracking-wide text-gray-500 uppercase">Pending Requests</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['pending_requests'] }}</p>
                    <p class="mt-1 text-sm text-red-600">
                        Requires attention
                    </p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="text-2xl text-yellow-600 fas fa-clipboard-list"></i>
                </div>
            </div>
        </div>

        <div class="relative p-6 overflow-hidden bg-white border-l-4 border-blue-900 shadow-lg rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium tracking-wide text-gray-500 uppercase">Active Work Orders</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['pending_work_orders'] }}</p>
                    <p class="mt-1 text-sm text-blue-600">
                        In progress
                    </p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="text-2xl text-purple-600 fas fa-wrench"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="mb-6 text-2xl font-bold text-gray-900">
            Quick Actions
        </h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <a href="{{ route('admin.users') }}" class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 group shadow-lg rounded-xl hover:shadow-xl hover:border-indigo-200">
                <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-br from-indigo-50 to-blue-50 group-hover:opacity-100"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="p-3 transition-colors duration-300 bg-indigo-100 rounded-lg group-hover:bg-indigo-200">
                        <i class="text-2xl text-indigo-600 fas fa-users"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 transition-colors group-hover:text-indigo-900">Manage Users</h3>
                        <p class="text-sm text-gray-600">View and manage system users</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.requests') }}" class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 group shadow-lg rounded-xl hover:shadow-xl hover:border-yellow-200">
                <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-br from-yellow-50 to-orange-50 group-hover:opacity-100"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="p-3 transition-colors duration-300 bg-yellow-100 rounded-lg group-hover:bg-yellow-200">
                        <i class="text-2xl text-yellow-600 fas fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 transition-colors group-hover:text-yellow-900">Review Requests</h3>
                        <p class="text-sm text-gray-600">Process maintenance requests</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.work-orders') }}" class="relative p-6 overflow-hidden transition-all duration-300 bg-white border border-gray-100 group shadow-lg rounded-xl hover:shadow-xl hover:border-purple-200">
                <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-br from-purple-50 to-pink-50 group-hover:opacity-100"></div>
                <div class="relative flex items-center space-x-4">
                    <div class="p-3 transition-colors duration-300 bg-purple-100 rounded-lg group-hover:bg-purple-200">
                        <i class="text-2xl text-purple-600 fas fa-wrench"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 transition-colors group-hover:text-purple-900">Manage Work Orders</h3>
                        <p class="text-sm text-gray-600">Oversee maintenance tasks</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <!-- Recent Requests -->
        <div class="p-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">
                    Recent Requests
                </h2>
                <a href="{{ route('admin.requests') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    View all
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentRequests as $request)
                    <div class="flex items-start p-4 space-x-4 transition-colors duration-200 rounded-lg bg-gray-50 hover:bg-gray-100">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $request->title }}</h4>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($request->status === 'approved') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-gray-600">{{ Str::limit($request->description, 80) }}</p>
                            <div class="flex items-center mt-2 text-xs text-gray-500">
                                {{ $request->submittedByUser->name }}
                                <span class="mx-2">•</span>
                                {{ $request->location->name }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center">
                        <p class="text-gray-500">No recent requests</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Work Orders -->
        <div class="p-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">
                    Recent Work Orders
                </h2>
                <a href="{{ route('admin.work-orders') }}" class="text-sm font-medium text-purple-600 hover:text-purple-800">
                    View all
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentWorkOrders as $workOrder)
                    <div class="flex items-start p-4 space-x-4 transition-colors duration-200 rounded-lg bg-gray-50 hover:bg-gray-100">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $workOrder->title }}</h4>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($workOrder->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($workOrder->status === 'completed') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($workOrder->status) }}
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-gray-600">{{ Str::limit($workOrder->description, 80) }}</p>
                            <div class="flex items-center mt-2 text-xs text-gray-500">
                                {{ $workOrder->assignedToUser->name }}
                                @if($workOrder->sourceRequest)
                                    <span class="mx-2">•</span>
                                    {{ $workOrder->sourceRequest->location->name }}
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center">
                        <p class="text-gray-500">No recent work orders</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
