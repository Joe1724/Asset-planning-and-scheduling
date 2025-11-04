@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">
            <i class="mr-3 text-orange-600 fas fa-wrench"></i>
            My Work Orders
        </h1>
        <p class="text-gray-600">Manage and complete your assigned maintenance tasks</p>
    </div>

    @if($workOrders->isNotEmpty())
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">Active Work Orders</h2>
                <p class="text-sm text-gray-600">Tasks assigned to you for completion</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Location</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Planning</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Priority</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($workOrders as $workOrder)
                            <tr class="transition-colors duration-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">#{{ $workOrder->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="mr-2 text-gray-400 fas fa-clipboard-list"></i>
                                        <span class="text-sm font-medium text-gray-900">{{ $workOrder->title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="mr-2 text-gray-400 fas fa-map-marker-alt"></i>
                                        <span class="text-sm text-gray-900">{{ $workOrder->sourceRequest->location->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs text-sm text-gray-900 truncate">{{ Str::limit($workOrder->description, 60) }}</div>
                                    <div class="mt-1 text-xs text-gray-500">{{ $workOrder->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($workOrder->planning_description)
                                        <div class="max-w-xs text-sm text-gray-900">{{ Str::limit($workOrder->planning_description, 60) }}</div>
                                        <a href="{{ route('technician.view-work-order', $workOrder->id) }}" class="text-xs text-blue-600 hover:text-blue-800">View details</a>
                                    @else
                                        <span class="text-xs text-gray-400">No planning details</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($workOrder->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="mr-1 fas fa-clock"></i>
                                            Pending
                                        </span>
                                    @elseif($workOrder->status === 'on_the_way')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="mr-1 fas fa-truck"></i>
                                            On the Way
                                        </span>
                                    @elseif($workOrder->status === 'in_progress')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="mr-1 fas fa-spinner fa-spin"></i>
                                            In Progress
                                        </span>
                                    @elseif($workOrder->status === 'completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="mr-1 fas fa-check"></i>
                                            Completed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($workOrder->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($workOrder->priority === 'high')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="mr-1 fas fa-exclamation-triangle"></i>
                                            High
                                        </span>
                                    @elseif($workOrder->priority === 'medium')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="mr-1 fas fa-exclamation-circle"></i>
                                            Medium
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="mr-1 fas fa-info-circle"></i>
                                            Low
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="flex flex-col space-y-2">
                                        <a href="{{ route('technician.view-work-order', $workOrder->id) }}"
                                           class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="mr-2 fas fa-eye"></i>
                                            View Details
                                        </a>
                                        @if($workOrder->status === 'pending')
                                            <form action="{{ route('technician.accept-work-order', $workOrder->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <i class="mr-2 fas fa-check"></i>
                                                    Accept
                                                </button>
                                            </form>
                                        @elseif($workOrder->status === 'on_the_way')
                                            <form action="{{ route('technician.start-work-order', $workOrder->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                    <i class="mr-2 fas fa-play"></i>
                                                    Start Work
                                                </button>
                                            </form>
                                        @elseif($workOrder->status === 'in_progress')
                                            <form action="{{ route('technician.complete-work-order', $workOrder->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    <i class="mr-2 fas fa-check"></i>
                                                    Complete
                                                </button>
                                            </form>
                                        @elseif($workOrder->status === 'completed')
                                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">
                                                <i class="mr-2 fas fa-check-circle"></i>
                                                Completed
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="p-12 bg-white shadow-lg rounded-xl">
            <div class="text-center">
                <i class="mb-4 text-6xl text-gray-300 fas fa-tools"></i>
                <h3 class="mb-2 text-lg font-medium text-gray-900">No Work Orders Assigned</h3>
                <p class="text-gray-500">You don't have any active work orders at the moment. New assignments will appear here when available.</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-4">
        <div class="p-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="text-2xl text-blue-600 fas fa-clock"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Tasks</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $workOrders->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <i class="text-2xl text-yellow-600 fas fa-truck"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">On the Way</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $workOrders->where('status', 'on_the_way')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="text-2xl text-blue-600 fas fa-spinner"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">In Progress</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $workOrders->where('status', 'in_progress')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="text-2xl text-green-600 fas fa-check-circle"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Completed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $workOrders->where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
