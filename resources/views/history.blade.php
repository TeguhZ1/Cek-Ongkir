@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
     style="background-image: url('https://plus.unsplash.com/premium_photo-1663950995673-f4916a77ca6d?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">

    <!-- Lapisan blur -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Konten -->
    <div class="relative z-10 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-4">
                    <i class="fas fa-history text-green-400 mr-3"></i>
                    Riwayat Cek Ongkir
                </h1>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                    Daftar riwayat pengecekan ongkos kirim Anda
                </p>
                <!-- Delete All Button -->
                @if($histories->count() > 0)
                <div class="absolute top-4 right-4">
                    <form action="{{ route('history.clear') }}" method="POST" class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua riwayat?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="p-3 bg-red-500/90 backdrop-blur-sm text-white rounded-full
                                       hover:bg-red-600 transition-all duration-200
                                       transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-trash-alt text-xl"></i>
                        </button>
                    </form>
                </div>
                @endif
            </div>

            @if(session('success'))
            <div class="mb-6">
                <div class="bg-green-500/90 backdrop-blur-sm text-white px-4 py-3 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- History List -->
            <div class="space-y-6">
                @forelse($histories as $history)
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                        <div class="bg-green-500 p-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-shipping-fast mr-2"></i>
                                {{ $history->courier }}
                            </h2>
                            <p class="text-sm text-green-100">
                                {{ $history->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Shipping Details -->
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-box text-green-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Berat Paket</p>
                                            <p class="font-semibold">{{ number_format($history->weight, 0, ',', '.') }} gram</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-green-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Rute</p>
                                            <p class="font-semibold">{{ $history->origin_city }} → {{ $history->destination_city }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service Details -->
                                <div class="bg-gray-50 p-4 rounded-xl">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-gray-800">{{ $history->service }}</h3>
                                            <div class="flex items-center mt-2 text-sm text-gray-600">
                                                <i class="far fa-clock text-green-500 mr-2"></i>
                                                Estimasi: {{ $history->etd }} hari
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-green-500">
                                                Rp {{ number_format($history->cost, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Riwayat</h3>
                        <p class="text-gray-600 mb-6">Anda belum pernah melakukan pengecekan ongkos kirim</p>
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-semibold rounded-xl
                                  shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-0.5">
                            <i class="fas fa-calculator mr-2"></i>
                            Cek Ongkir Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
