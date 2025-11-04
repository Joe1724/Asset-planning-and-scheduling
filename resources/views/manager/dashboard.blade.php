@extends('layouts.app')

@section('content')
<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Review Maintenance Requests</h1>
            @if($notifications->count() > 0)
                <div class="px-3 py-1 text-sm text-blue-800 bg-blue-100 rounded-full">
                    {{ $notifications->count() }} unread notification{{ $notifications->count() > 1 ? 's' : '' }}
                </div>
            @endif
        </div>

        @if($notifications->count() > 0)
            <div class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50">
                <h3 class="mb-3 text-lg font-semibold text-blue-900">Notifications</h3>
                @foreach($notifications as $notification)
                    <div class="p-3 mb-2 bg-white border border-blue-200 rounded">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="font-medium text-blue-900">{{ $notification->title }}</h4>
                                <p class="text-sm text-blue-800">{{ $notification->message }}</p>
                                <p class="mt-1 text-xs text-blue-600">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            <form action="{{ route('manager.mark-notification-read', $notification->id) }}" method="POST" class="ml-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-sm text-blue-600 underline hover:text-blue-800">
                                    Mark as Read
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <h2 class="mb-4 text-xl font-semibold">Pending Requests</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Location</th>
                        <th class="px-4 py-2 border">Submitted By</th>
                        <th class="px-4 py-2 border">Description</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $request->id }}</td>
                            <td class="px-4 py-2 border">{{ $request->location->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $request->submittedByUser->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ Str::limit($request->description, 50) }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 text-xs text-yellow-800 bg-yellow-100 rounded-full">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <form action="{{ route('manager.convert-to-work-order', $request->id) }}" method="POST" class="space-y-2">
                                    @csrf
                                    <div>
                                        <label for="planning_description_{{ $request->id }}" class="block mb-1 text-xs font-medium text-gray-700">
                                            Planning Description
                                        </label>
                                        <textarea name="planning_description" id="planning_description_{{ $request->id }}"
                                                  rows="3" class="w-full px-2 py-1 text-sm border border-gray-300 rounded resize-none"
                                                  placeholder="Add planning details for the technician..."></textarea>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <select name="technician_id" class="px-2 py-1 text-sm border border-gray-300 rounded" required>
                                            <option value="">Select Technician</option>
                                            @foreach($technicians as $technician)
                                                <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="px-3 py-1 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                            Convert to Work Order
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($requests->isEmpty())
            <p class="mt-4 text-gray-500">No submitted requests to review.</p>
        @endif

        @if (session()->has('message'))
            <div class="px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
@endsection
