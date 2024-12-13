<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CekOngkir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-[Poppins] bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Left Side -->
        <div class="hidden lg:flex lg:w-1/2 relative">
            <!-- Logo dan Judul -->
            <div class="absolute top-0 left-0 p-8 z-20">
                <div class="flex items-center gap-2">
                    <i class="fas fa-truck-fast text-white text-3xl drop-shadow-lg"></i>
                    <span class="text-white text-2xl font-bold tracking-wide drop-shadow-lg">CekOngkir</span>
                </div>
            </div>

            <!-- Background Image dengan Overlay -->
            <div class="absolute inset-0 bg-cover bg-center"
                 style="background-image: url('https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3');">
                <div class="absolute inset-0 bg-black bg-opacity-30 backdrop-filter backdrop-blur-md"></div>
            </div>

            <!-- Text Content -->
            <div class="relative z-10 flex flex-col justify-center px-12 w-full">
                <h2 class="text-white text-5xl font-bold leading-tight mb-6 filter drop-shadow-lg">
                    Temukan Tarif Pengiriman Terbaik Untuk Setiap Kebutuhan
                </h2>
                <p class="text-white text-xl filter drop-shadow-md">
                    Layanan cek ongkir dengan dukungan ekspedisi terpercaya di Indonesia
                </p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Login</h2>
                    <p class="text-gray-600">Gunakan akun anda untuk login</p>
                </div>

                @if (session('success'))
                <div class="mb-8">
                    <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-2xl text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-500 bg-white text-gray-700"
                                    placeholder="Masukkan email anda">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" required
                                    class="w-full pl-10 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-500 bg-white text-gray-700"
                                    placeholder="Masukkan password">
                                <button type="button"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center text-gray-600">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                            Ingat Saya
                        </label>
                        <a href="{{ route('password.request') }}" class="text-blue-500 hover:text-blue-600">Lupa Password?</a>
                    </div>

                    <button type="submit"
                            class="w-full bg-green-500 text-white py-4 rounded-lg font-semibold hover:bg-green-400
                                   transition-all duration-300 transform hover:-translate-y-0.5
                                   shadow-lg hover:shadow-xl">
                        Masuk
                    </button>
                </form>

                <p class="text-gray-600 text-center mt-8">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-orange-500 hover:text-orange-400 transition duration-300">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.querySelectorAll('button[type="button"]').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>
