@extends('layouts.admin')

@section('title', 'Maintenance Requests')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Title</th>
                        <th class="px-4 py-2 border">Submitted By</th>
                        <th class="px-4 py-2 border">Location</th>
                        <th class="px-4 py-2 border">Description</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Created At</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $request->id }}</td>
                            <td class="px-4 py-2 border">{{ $request->title }}</td>
                            <td class="px-4 py-2 border">{{ $request->submittedByUser->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $request->location->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ Str::limit($request->description, 50) }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($request->status === 'approved') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">{{ $request->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-2 border">
                                @if($request->status === 'pending')
                                    <form action="{{ route('admin.convert-to-work-order', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                            Convert to Work Order
                                        </button>
                                    </form>
                                @else
                                    <span class="text-sm text-gray-500">Already processed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($requests->isEmpty())
            <p class="mt-4 text-gray-500">No maintenance requests found.</p>
        @endif
    </div>
</div>
@endsection
