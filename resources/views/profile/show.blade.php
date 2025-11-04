<x-app-layout>
    <div class="p-8">
        <div class="mb-8">
            <h1 class="mb-2 text-3xl font-bold text-gray-900">
                <i class="mr-3 text-indigo-600 fas fa-user-cog"></i>
                Account Settings
            </h1>
            <p class="text-gray-600">Manage your account information and security settings</p>
        </div>

        <div class="space-y-8">
            <!-- Profile Information -->
            <div class="p-6 bg-white shadow-lg rounded-xl">
                <div class="mb-6">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900">Profile Information</h2>
                    <p class="text-gray-600">Update your account's profile information and email address.</p>
                </div>
                <form action="{{ route('user-profile-information.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                   class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                                   class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="relative flex justify-center px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-lg shadow-sm group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:shadow-md">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Update Password -->
            <div class="p-6 bg-white shadow-lg rounded-xl">
                <div class="mb-6">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900">Update Password</h2>
                    <p class="text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <form action="{{ route('user-password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label for="current_password" class="block mb-2 text-sm font-medium text-gray-700">Current Password</label>
                            <input id="current_password" type="password" name="current_password" required
                                   class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700">New Password</label>
                            <input id="password" type="password" name="password" required
                                   class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                   class="block w-full px-4 py-3 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="relative flex justify-center px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-lg shadow-sm group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:shadow-md">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Two Factor Authentication -->
            <div class="p-6 bg-white shadow-lg rounded-xl">
                <div class="mb-6">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900">Two Factor Authentication</h2>
                    <p class="text-gray-600">Add additional security to your account using two factor authentication.</p>
                </div>
                <!-- Two factor authentication content will be added here -->
            </div>

            <!-- Browser Sessions -->
            <div class="p-6 bg-white shadow-lg rounded-xl">
                <div class="mb-6">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900">Browser Sessions</h2>
                    <p class="text-gray-600">Manage and log out your active sessions on other browsers and devices.</p>
                </div>
                <!-- Browser sessions content will be added here -->
            </div>

            <!-- Delete Account -->
            <div class="p-6 bg-white border-l-4 border-red-500 shadow-lg rounded-xl">
                <div class="mb-6">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900">Delete Account</h2>
                    <p class="text-gray-600">Permanently delete your account and all associated data.</p>
                </div>
                <!-- Delete account content will be added here -->
            </div>
        </div>
    </div>
</x-app-layout>
