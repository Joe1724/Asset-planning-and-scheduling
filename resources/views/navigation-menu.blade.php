<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <div class="text-xl font-bold text-gray-800">OpsCore</div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out border-b-2 {{ request()->routeIs('dashboard') ? 'border-indigo-400 text-gray-900 focus:outline-none focus:border-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300' }}">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Notification Bell Icon -->
                @auth
                    @php
                        $userNotifications = \App\Models\Notification::forUser(auth()->id())->unread()->get();
                    @endphp
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="text-xl fas fa-bell"></i>
                            @if($userNotifications->count() > 0)
                                <span class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 text-xs text-white bg-red-500 rounded-full">
                                    {{ $userNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <!-- Notification Dropdown -->
                        <div x-show="open"
                              @click.away="open = false"
                              x-transition:enter="transition ease-out duration-100"
                              x-transition:enter-start="transform opacity-0 scale-95"
                              x-transition:enter-end="transform opacity-100 scale-100"
                              x-transition:leave="transition ease-in duration-75"
                              x-transition:leave-start="transform opacity-100 scale-100"
                              x-transition:leave-end="transform opacity-0 scale-95"
                              class="absolute right-0 z-50 mt-2 origin-top-right bg-white rounded-md shadow-lg w-80">
                            <div class="p-4 bg-white rounded-md shadow-xs">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
                                    @if($userNotifications->count() > 0)
                                        <span class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
                                            {{ $userNotifications->count() }} unread
                                        </span>
                                    @endif
                                </div>
                                <div class="border-t border-gray-200"></div>
                                @if($userNotifications->count() > 0)
                                    <div class="overflow-y-auto max-h-96">
                                        @foreach($userNotifications as $notification)
                                            <div class="py-2 border-b border-gray-100 last:border-0">
                                                <div class="flex items-start">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-900 truncate">
                                                            {{ $notification->title }}
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $notification->message }}
                                                        </p>
                                                        <p class="text-xs text-gray-400">
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <div class="ml-2">
                                                        <form method="POST" action="{{ route('mark-notification-read', $notification->id) }}" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-xs text-blue-600 hover:text-blue-800">
                                                                Mark as read
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="py-4 text-sm text-center text-gray-500">No notifications</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endauth


                <!-- Settings Dropdown -->
                <div class="relative ms-3" x-data="{ open: false }">
                    <button @click="open = !open" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                        {{ Auth::user()->name }}
                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-50 w-48 mt-2 bg-white rounded-md shadow-lg">
                        <div class="py-1">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" @click.prevent="$root.submit();" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-base font-medium text-gray-900 {{ request()->routeIs('dashboard') ? 'bg-gray-100' : 'hover:bg-gray-100' }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div>
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" @click.prevent="$root.submit();" class="block w-full px-4 py-2 text-base font-medium text-left text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
