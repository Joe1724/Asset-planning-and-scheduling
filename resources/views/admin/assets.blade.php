@extends('layouts.admin')

@section('title', 'Asset Management')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Category</th>
                        <th class="px-4 py-2 border">Location</th>
                        <th class="px-4 py-2 border">Manufacturer</th>
                        <th class="px-4 py-2 border">Model</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Serial Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assets as $asset)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $asset->id }}</td>
                            <td class="px-4 py-2 border">{{ $asset->name }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 text-xs text-purple-800 bg-purple-100 rounded-full">
                                    {{ ucfirst($asset->category) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">{{ $asset->location->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $asset->manufacturer ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $asset->model_number ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($asset->status === 'active') bg-green-100 text-green-800
                                    @elseif($asset->status === 'inactive') bg-gray-100 text-gray-800
                                    @elseif($asset->status === 'maintenance') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($asset->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">{{ $asset->serial_number ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($assets->isEmpty())
            <p class="mt-4 text-gray-500">No assets found.</p>
        @endif
    </div>
</div>
@endsection
