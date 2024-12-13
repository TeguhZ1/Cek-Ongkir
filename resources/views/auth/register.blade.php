@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
     style="background-image: url('https://plus.unsplash.com/premium_photo-1663950995673-f4916a77ca6d?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">

    <!-- Lapisan blur -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Konten -->
    <div class="relative z-10 py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-4">
                    <i class="fas fa-user-plus text-green-400 mr-3"></i>
                    Daftar Akun
                </h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                    Buat akun baru untuk menggunakan layanan CekOngkir
                </p>
            </div>

            <!-- Register Card -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-green-500 p-6">
                    <h2 class="text-2xl font-semibold text-white text-center">
                        <i class="fas fa-user-circle mr-2"></i>
                        Daftar Pengguna Baru
                    </h2>
                </div>

                <div class="p-6 lg:p-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Name -->
                            <div class="col-span-1">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:ring-green-500 focus:border-green-500"
                                           required autofocus>
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-span-1">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:ring-green-500 focus:border-green-500"
                                           required>
                                </div>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="col-span-1">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" id="password" name="password"
                                           class="w-full pl-10 pr-12 py-3 rounded-lg border border-gray-200 focus:ring-green-500 focus:border-green-500"
                                           required>
                                    <button type="button" onclick="togglePassword('password')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-span-1">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="w-full pl-10 pr-12 py-3 rounded-lg border border-gray-200 focus:ring-green-500 focus:border-green-500"
                                           required>
                                    <button type="button" onclick="togglePassword('password_confirmation')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-span-1">
                                <button type="submit"
                                        class="w-full bg-green-500 text-white py-4 rounded-lg font-semibold hover:bg-green-600
                                               transition-all duration-300 transform hover:-translate-y-0.5
                                               shadow-lg hover:shadow-xl">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Daftar Sekarang
                                </button>
                            </div>

                            <div class="col-span-1">
                                <p class="text-center text-gray-600">
                                    Sudah punya akun?
                                    <a href="{{ route('login') }}" class="text-green-500 hover:text-green-600 font-semibold">
                                        Login
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = event.currentTarget.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
