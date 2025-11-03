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
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="p-6 bg-white shadow-modern rounded-xl">
                    <div class="mb-6">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900">
                            <i class="mr-2 text-blue-600 fas fa-user-edit"></i>
                            Profile Information
                        </h2>
                        <p class="text-gray-600">Update your account's profile information and email address.</p>
                    </div>
                    @livewire('profile.update-profile-information-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="p-6 bg-white shadow-modern rounded-xl">
                    <div class="mb-6">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900">
                            <i class="mr-2 text-green-600 fas fa-key"></i>
                            Password
                        </h2>
                        <p class="text-gray-600">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    @livewire('profile.update-password-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="p-6 bg-white shadow-modern rounded-xl">
                    <div class="mb-6">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900">
                            <i class="mr-2 text-purple-600 fas fa-shield-alt"></i>
                            Two Factor Authentication
                        </h2>
                        <p class="text-gray-600">Add additional security to your account using two factor authentication.</p>
                    </div>
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            <div class="p-6 bg-white shadow-modern rounded-xl">
                <div class="mb-6">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900">
                        <i class="mr-2 text-orange-600 fas fa-globe"></i>
                        Browser Sessions
                    </h2>
                    <p class="text-gray-600">Manage and log out your active sessions on other browsers and devices.</p>
                </div>
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="p-6 bg-white border-l-4 border-red-500 shadow-modern rounded-xl">
                    <div class="mb-6">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900">
                            <i class="mr-2 text-red-600 fas fa-exclamation-triangle"></i>
                            Delete Account
                        </h2>
                        <p class="text-gray-600">Permanently delete your account and all associated data.</p>
                    </div>
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
