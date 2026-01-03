<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MedNet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Vanta.js Libraries sssss-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.cells.min.js"></script> 
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-2 md:p-4">
    <div id="vanta-bg" class="fixed inset-0 -z-10"></div>

    <!-- Home Button -->
    <a href="{{ url('/') }}" class="fixed top-6 left-6 z-50 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white rounded-full shadow-lg hover:shadow-xl flex items-center justify-center transition-all duration-300 hover:scale-110 group" title="Back to Home">
        <i class='bx bx-home text-xl group-hover:scale-110 transition-transform'></i>
    </a>

    <div class="w-full max-w-6xl flex flex-col lg:flex-row gap-4 lg:gap-0 animate-fadeInUp">
        
        <!-- Left Side - Branding -->
        <div class="lg:w-1/2 flex flex-col justify-center items-center text-white p-4 lg:p-6">
            <div class="max-w-md">
                <div class="mb-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl mb-3">
                        <i class='bx bx-shield-alt-2 text-4xl'></i>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-2">Admin Portal</h1>
                    <p class="text-base text-indigo-100 mb-4">Secure access to the MedNet administration dashboard.</p>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold text-sm">Manage Platform</h3>
                            <p class="text-xs text-indigo-100">Full control over the system</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold text-sm">User Management</h3>
                            <p class="text-xs text-indigo-100">Oversee all user accounts</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class='bx bx-check-circle text-xl text-green-300'></i>
                        <div>
                            <h3 class="font-semibold text-sm">Analytics</h3>
                            <p class="text-xs text-indigo-100">Track performance metrics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="lg:w-1/2 flex items-center justify-center p-4">
            <div class="w-full max-w-md glass-effect rounded-3xl shadow-2xl p-4 lg:p-6">
                
                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl mb-2">
                        <i class='bx bx-shield text-white text-2xl'></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Admin Login</h2>
                    <p class="text-sm text-gray-600">Authorized personnel only</p>
                </div>

                <!-- Demo Credentials -->
                <div class="mb-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <i class='bx bx-shield text-blue-600 text-lg'></i>
                        <h3 class="text-xs font-semibold text-blue-900">Admin Demo Account</h3>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:bg-blue-50 transition-colors cursor-pointer group" 
                             onclick="fillAdminCredentials('admin@admin.com', 'adminadmin')"
                             title="Click to paste credentials">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500">Email</p>
                                <p class="text-sm font-mono text-gray-800 font-medium">admin@admin.com</p>
                            </div>
                            <i class='bx bx-copy text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity'></i>
                        </div>
                        <div class="flex items-center justify-between gap-3 p-2 bg-white rounded-lg hover:bg-blue-50 transition-colors cursor-pointer group" 
                             onclick="fillAdminCredentials('admin@admin.com', 'adminadmin')"
                             title="Click to paste credentials">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500">Password</p>
                                <p class="text-sm font-mono text-gray-800 font-medium">adminadmin</p>
                            </div>
                            <i class='bx bx-copy text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity'></i>
                        </div>
                    </div>
                    <p class="text-xs text-blue-700 mt-1 text-center">Click on credentials to auto-fill</p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="mb-3 p-3 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-start">
                        <i class='bx bx-check-circle text-green-600 text-lg mr-2 mt-0.5'></i>
                        <p class="text-xs text-green-700">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-3 p-3 bg-red-50 border-l-4 border-red-500 rounded-lg">
                        <div class="flex items-start">
                            <i class='bx bx-error-circle text-red-600 text-lg mr-2 mt-0.5'></i>
                            <div class="flex-1">
                                @foreach($errors->all() as $error)
                                    <p class="text-xs text-red-700">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
                    @csrf

                    <!-- Email or Username -->
                    <div>
                        <label for="login" class="block text-xs font-semibold text-gray-700 mb-1">
                            Email or Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-user-circle text-gray-400 text-lg'></i>
                            </div>
                            <input 
                                type="text" 
                                id="login" 
                                name="login" 
                                value="{{ old('login') }}"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 input-focus"
                                placeholder="admin@mednet.com"
                                required 
                                autofocus
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-semibold text-gray-700 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-lock-alt text-gray-400 text-lg'></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 input-focus"
                                placeholder="••••••••"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword()" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                                title="Toggle password visibility"
                            >
                                <i class='bx bx-show text-lg' id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-3.5 h-3.5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer"
                            >
                            <span class="ml-2 text-xs text-gray-600">Keep me signed in</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-2.5 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 btn-hover flex items-center justify-center space-x-2"
                    >
                        <i class='bx bx-log-in text-lg'></i>
                        <span class="text-sm">Admin Sign In</span>
                    </button>

                    <!-- Security Notice -->
                    <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-start">
                            <i class='bx bx-info-circle text-yellow-600 text-base mr-2 mt-0.5'></i>
                            <p class="text-xs text-yellow-800">
                                This area is restricted to authorized administrators only. All login attempts are logged and monitored.
                            </p>
                        </div>
                    </div>

                    <!-- Back to Customer Login -->
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="inline-flex items-center text-xs text-indigo-600 hover:text-indigo-700 font-medium transition-colors">
                            <i class='bx bx-left-arrow-alt text-base mr-1'></i>
                            Back to Customer Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function fillAdminCredentials(username, password) {
        document.getElementById('login').value = username;
        document.getElementById('password').value = password;
        
        const loginInput = document.getElementById('login');
        const passwordInput = document.getElementById('password');
        
        loginInput.classList.add('ring-2', 'ring-blue-500');
        passwordInput.classList.add('ring-2', 'ring-blue-500');
        
        setTimeout(() => {
            loginInput.classList.remove('ring-2', 'ring-blue-500');
            passwordInput.classList.remove('ring-2', 'ring-blue-500');
        }, 1000);
    }
    
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bx-show');
            toggleIcon.classList.add('bx-hide');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bx-hide');
            toggleIcon.classList.add('bx-show');
        }
    }
</script>
<script>
            VANTA.CELLS({
                el: "#vanta-bg",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                color1: 0x95209,
                color2: 0xb8b570,
                size: 1.90,
                speed: 0.50
            });
        </script>
</body>
</html>
