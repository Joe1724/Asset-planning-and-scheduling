@extends('layouts.app')

@section('content')
<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="mb-4 text-2xl font-bold">Review Maintenance Requests</h1>

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
                                <form action="{{ route('manager.convert-to-work-order', $request->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                        Convert to Work Order
                                    </button>
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
