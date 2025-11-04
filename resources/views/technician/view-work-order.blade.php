@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">Work Order Details</h1>
        <p class="text-gray-600">Complete information about your assigned work order</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Work Order Header -->
        <div class="p-6 mb-6 bg-white shadow-lg rounded-xl">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-gray-900">Work Order #{{ $workOrder->id }}</h2>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($workOrder->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($workOrder->status === 'on_the_way') bg-blue-100 text-blue-800
                    @elseif($workOrder->status === 'in_progress') bg-blue-100 text-blue-800
                    @elseif($workOrder->status === 'completed') bg-green-100 text-green-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($workOrder->status) }}
                </span>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <p class="text-sm text-gray-600">Assigned To</p>
                    <p class="font-medium">{{ $workOrder->assignedToUser->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Created By</p>
                    <p class="font-medium">{{ $workOrder->generatedByUser->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Created At</p>
                    <p class="font-medium">{{ $workOrder->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Priority</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($workOrder->priority === 'high') bg-red-100 text-red-800
                        @elseif($workOrder->priority === 'medium') bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800 @endif">
                        {{ ucfirst($workOrder->priority) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Request Details -->
        <div class="p-6 mb-6 bg-white shadow-lg rounded-xl">
            <h3 class="mb-4 text-xl font-bold text-gray-900">Request Information</h3>
            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                <div>
                    <p class="text-sm text-gray-600">Location</p>
                    <p class="font-medium">{{ $workOrder->sourceRequest->location->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Submitted By</p>
                    <p class="font-medium">{{ $workOrder->sourceRequest->submittedByUser->name }}</p>
                </div>
            </div>
            <div>
                <p class="mb-2 text-sm text-gray-600">Description</p>
                <p class="p-3 text-gray-900 rounded bg-gray-50">{{ $workOrder->sourceRequest->description }}</p>
            </div>
        </div>

        <!-- Planning Description -->
        @if($workOrder->planning_description)
        <div class="p-6 mb-6 border border-blue-200 shadow-lg bg-blue-50 rounded-xl">
            <h3 class="mb-4 text-xl font-bold text-blue-900">
                <i class="mr-2 fas fa-clipboard-list"></i>
                Planning Details
            </h3>
            <p class="p-4 text-blue-800 bg-white border border-blue-200 rounded">{{ $workOrder->planning_description }}</p>
        </div>
        @endif

        <!-- Work Order Description -->
        <div class="p-6 mb-6 bg-white shadow-lg rounded-xl">
            <h3 class="mb-4 text-xl font-bold text-gray-900">Work Order Description</h3>
            <p class="p-3 text-gray-900 rounded bg-gray-50">{{ $workOrder->description }}</p>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <a href="{{ route('technician.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="mr-2 fas fa-arrow-left"></i>
                Back to Dashboard
            </a>

            @if($workOrder->status === 'pending')
                <form action="{{ route('technician.accept-work-order', $workOrder->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="mr-2 fas fa-check"></i>
                        Accept Work Order
                    </button>
                </form>
            @elseif($workOrder->status === 'on_the_way')
                <form action="{{ route('technician.start-work-order', $workOrder->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <i class="mr-2 fas fa-play"></i>
                        Start Work
                    </button>
                </form>
            @elseif($workOrder->status === 'in_progress')
                <form action="{{ route('technician.complete-work-order', $workOrder->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="mr-2 fas fa-check"></i>
                        Complete Work Order
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
