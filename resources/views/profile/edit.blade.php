@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
     style="background-image: url('https://plus.unsplash.com/premium_photo-1663950995673-f4916a77ca6d?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">

    <!-- Lapisan blur -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Konten -->
    <div class="relative z-10 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-4">
                    <i class="fas fa-user-circle text-green-400 mr-3"></i>
                    Pengaturan Akun
                </h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                    Update Informasi Akun Anda
                </p>
            </div>

            @if(session('success'))
            <div class="mb-8">
                <div class="bg-green-500/90 backdrop-blur-sm text-white px-4 py-3 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Profile Card -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <!-- Card Header -->
                <div class="bg-green-500 p-6">
                    <h2 class="text-2xl font-semibold text-white text-center">
                        <i class="fas fa-user-edit mr-2"></i>
                        Edit Profile
                    </h2>
                </div>

                <!-- Card Body -->
                <div class="p-6 lg:p-8">
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required autofocus>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-semibold
                                           rounded-xl shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-0.5">
                                <i class="fas fa-save mr-2"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Update Card -->
            <div class="mt-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-green-500 p-6">
                    <h2 class="text-2xl font-semibold text-white text-center">
                        <i class="fas fa-lock mr-2"></i>
                        Update Password
                    </h2>
                </div>

                <div class="p-6 lg:p-8">
                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password Saat Ini
                            </label>
                            <input type="password" id="current_password" name="current_password"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password Baru
                            </label>
                            <input type="password" id="password" name="password"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-semibold
                                           rounded-xl shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-0.5">
                                <i class="fas fa-key mr-2"></i>
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
