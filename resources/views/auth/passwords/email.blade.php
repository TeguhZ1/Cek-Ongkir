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
                    <i class="fas fa-key text-green-400 mr-3"></i>
                    Reset Password
                </h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                    Masukkan email Anda untuk mereset password
                </p>
            </div>

            @if (session('status'))
            <div class="mb-8">
                <div class="bg-green-500/90 backdrop-blur-sm text-white px-4 py-3 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-2"></i>
                        <p>{{ session('status') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Reset Password Card -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-green-500 p-6">
                    <h2 class="text-2xl font-semibold text-white text-center">
                        <i class="fas fa-envelope mr-2"></i>
                        Kirim Link Reset Password
                    </h2>
                </div>

                <div class="p-6 lg:p-8">
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                                   required autofocus>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('login') }}"
                               class="text-sm text-green-600 hover:text-green-500">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Kembali ke Login
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-semibold
                                           rounded-xl shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-0.5">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Link Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
