@extends('layouts.admin')

@section('title', 'Location Management')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Parent Location</th>
                        <th class="px-4 py-2 border">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $location->id }}</td>
                            <td class="px-4 py-2 border">{{ $location->name }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded-full">
                                    {{ ucfirst($location->type) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $location->parent ? $location->parent->name : 'N/A' }}
                            </td>
                            <td class="px-4 py-2 border">{{ $location->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($locations->isEmpty())
            <p class="mt-4 text-gray-500">No locations found.</p>
        @endif
    </div>
</div>
@endsection
