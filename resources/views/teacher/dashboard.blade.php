@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="mb-2 text-3xl font-bold text-gray-900">
            <i class="mr-3 text-green-600 fas fa-plus-circle"></i>
            Submit Maintenance Request
        </h1>
        <p class="text-gray-600">Report maintenance issues for your classroom or facility</p>
    </div>

    <div class="p-8 bg-white shadow-modern rounded-xl">
        <div class="mb-6">
            <h2 class="mb-2 text-xl font-semibold text-gray-900">
                <i class="mr-2 text-blue-600 fas fa-tools"></i>
                Maintenance Request Details
            </h2>
            <p class="text-gray-600">Please provide details about the maintenance issue</p>
        </div>

        <form action="{{ route('teacher.submit-request') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="location_id" class="block mb-2 text-sm font-medium text-gray-700">
                    <i class="mr-2 text-gray-500 fas fa-map-marker-alt"></i>
                    Location
                </label>
                <div class="relative">
                    <select name="location_id" id="location_id" required
                            class="block w-full py-3 pl-4 pr-10 text-base transition-colors duration-200 bg-white border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select a location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="text-gray-400 fas fa-chevron-down"></i>
                    </div>
                </div>
                @error('location_id')
                    <p class="flex items-center mt-2 text-sm text-red-600">
                        <i class="mr-2 fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">
                    <i class="mr-2 text-gray-500 fas fa-comment-alt"></i>
                    Description
                </label>
                <div class="relative">
                    <textarea name="description" id="description" rows="5" required
                              placeholder="Please describe the maintenance issue in detail..."
                              class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm resize-none focus:ring-blue-500 focus:border-blue-500"
                              style="min-height: 120px;"></textarea>
                    <div class="absolute text-xs text-gray-400 bottom-3 right-3">
                        <span x-data="{ count: 0 }" x-init="$watch($el.previousElementSibling, value => count = value.value.length)" x-text="count"></span>/500
                    </div>
                </div>
                <p class="mt-1 text-sm text-gray-500">Provide as much detail as possible to help maintenance staff understand the issue.</p>
                @error('description')
                    <p class="flex items-center mt-2 text-sm text-red-600">
                        <i class="mr-2 fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    <i class="mr-2 fas fa-info-circle"></i>
                    Your request will be reviewed by a manager before being assigned to a technician.
                </div>
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:shadow-md">
                    <i class="mr-2 fas fa-paper-plane"></i>
                    Submit Request
                </button>
            </div>
        </form>
    </div>

    <div class="p-6 mt-8 border border-blue-200 bg-blue-50 rounded-xl">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="text-xl text-blue-600 fas fa-lightbulb"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-blue-900">Tips for Better Requests</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <ul class="space-y-1 list-disc list-inside">
                        <li>Be specific about what's broken or needs repair</li>
                        <li>Include any error messages or unusual behavior</li>
                        <li>Mention when the issue started occurring</li>
                        <li>Specify urgency level if it's affecting teaching</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
