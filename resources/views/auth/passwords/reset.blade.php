@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
     style="background-image: url('https://plus.unsplash.com/premium_photo-1663950995673-f4916a77ca6d?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">

    <!-- Lapisan blur -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Konten -->
    <div class="relative z-10 py-12">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-4">
                    <i class="fas fa-lock text-green-400 mr-3"></i>
                    Reset Password
                </h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                    Buat password baru untuk akun Anda
                </p>
            </div>

            <!-- Reset Password Card -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-green-500 p-6">
                    <h2 class="text-2xl font-semibold text-white text-center">
                        <i class="fas fa-key mr-2"></i>
                        Buat Password Baru
                    </h2>
                </div>

                <div class="p-6 lg:p-8">
                    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required autofocus>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

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

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-semibold
                                           rounded-xl shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-0.5">
                                <i class="fas fa-save mr-2"></i>
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
