<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to AssetEd - Professional Maintenance Management System">
    <title>Login - AssetEd</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .shadow-modern { box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-4 py-12 bg-gradient-primary sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="p-8 bg-white shadow-modern rounded-xl">
            <div class="text-center">
                <i class="w-16 h-16 mx-auto mb-4 text-4xl text-indigo-600 fas fa-tools"></i>
                <h2 class="mb-2 text-3xl font-bold text-gray-900">Welcome Back</h2>
                <p class="text-gray-600">Sign in to your AssetEd account</p>
            </div>

            @if($errors->any())
                <div class="flex items-center p-4 mt-6 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md shadow-sm">
                    <i class="mr-3 text-red-500 fas fa-exclamation-triangle"></i>
                    <div>
                        <ul class="text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                        <i class="mr-2 text-gray-500 fas fa-envelope"></i>
                        Email Address
                    </label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="block w-full py-3 pl-4 pr-4 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Enter your email">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="text-gray-400 fas fa-envelope"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">
                        <i class="mr-2 text-gray-500 fas fa-lock"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="block w-full py-3 pl-4 pr-10 text-base transition-colors duration-200 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Enter your password">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none" onclick="togglePassword()">
                                <i id="password-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="remember_me" class="block ml-2 text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <span class="text-gray-600">Forgot your password? </span>
                        <span class="text-gray-400">Contact administrator</span>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="relative flex justify-center w-full px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-lg shadow-sm group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:shadow-md">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="text-indigo-500 fas fa-sign-in-alt group-hover:text-indigo-400"></i>
                        </span>
                        Sign In
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        <i class="mr-1 fas fa-info-circle"></i>
                        Contact your administrator for account access
                    </p>
                </div>
            </form>
        </div>

        <div class="text-center">
            <p class="text-sm text-white opacity-80">
                <i class="mr-2 fas fa-shield-alt"></i>
                Secure login powered by AssetEd
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('password-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
