@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Role</th>
                        <th class="px-4 py-2 border">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $user->id }}</td>
                            <td class="px-4 py-2 border">{{ $user->name }}</td>
                            <td class="px-4 py-2 border">{{ $user->email }}</td>
                            <td class="px-4 py-2 border">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($user->role === 'admin') bg-red-100 text-red-800
                                    @elseif($user->role === 'manager') bg-blue-100 text-blue-800
                                    @elseif($user->role === 'technician') bg-green-100 text-green-800
                                    @elseif($user->role === 'teacher') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->isEmpty())
            <p class="mt-4 text-gray-500">No users found.</p>
        @endif
    </div>
</div>
@endsection
