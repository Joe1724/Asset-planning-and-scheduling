<div class="p-6">
    <div class="mb-8">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">
            <i class="mr-3 text-blue-600 fas fa-clipboard-check"></i>
            Review Maintenance Requests
        </h1>
        <p class="text-gray-600">Review and approve maintenance requests from teachers</p>
    </div>

    @if (session()->has('message'))
        <div class="flex items-center p-4 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md shadow-sm">
            <i class="mr-3 text-green-500 fas fa-check-circle"></i>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="flex items-center p-4 mb-6 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md shadow-sm">
            <i class="mr-3 text-red-500 fas fa-exclamation-triangle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($requests->isNotEmpty())
        <div class="overflow-hidden bg-white shadow-modern rounded-xl">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">Pending Requests</h2>
                <p class="text-sm text-gray-600">Requests awaiting your approval</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Location</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Submitted By</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($requests as $request)
                            <tr class="transition-colors duration-200 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">#{{ $request->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="mr-2 text-gray-400 fas fa-map-marker-alt"></i>
                                        <span class="text-sm text-gray-900">{{ $request->location->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-8 h-8">
                                            <div class="flex items-center justify-center w-8 h-8 bg-gray-300 rounded-full">
                                                <i class="text-gray-600 fas fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $request->submittedByUser->name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs text-sm text-gray-900 truncate">{{ Str::limit($request->description, 60) }}</div>
                                    <div class="mt-1 text-xs text-gray-500">{{ $request->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="mr-1 fas fa-clock"></i>
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <button wire:click="convertToWorkOrder({{ $request->id }})"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="mr-2 fas fa-plus"></i>
                                        Convert to Work Order
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="p-12 bg-white shadow-modern rounded-xl">
            <div class="text-center">
                <i class="mb-4 text-6xl text-gray-300 fas fa-clipboard-check"></i>
                <h3 class="mb-2 text-lg font-medium text-gray-900">No Pending Requests</h3>
                <p class="text-gray-500">All maintenance requests have been processed. Check back later for new submissions.</p>
            </div>
        </div>
    @endif
</div>
