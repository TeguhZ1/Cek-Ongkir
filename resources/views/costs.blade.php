@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
     style="background-image: url('https://plus.unsplash.com/premium_photo-1663950995673-f4916a77ca6d?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">

    <!-- Lapisan blur -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Konten -->
    <div class="relative z-10 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-4">
                    <i class="fas fa-receipt text-green-400 mr-3"></i>
                    Hasil Pencarian Ongkos Kirim
                </h1>
                <p class="text-xl text-gray-200">
                    Berat Paket: {{ number_format($weight, 0, ',', '.') }} gram
                </p>
            </div>

            <!-- Results -->
            <div class="space-y-6">
                @foreach($results as $result)
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-green-500 p-4">
                        <h2 class="text-xl font-semibold text-white text-center">
                            <i class="fas fa-shipping-fast mr-2"></i>
                            {{ $result['name'] }}
                        </h2>
                    </div>

                    <div class="p-6 space-y-4">
                        @foreach($result['costs'] as $cost)
                        <div class="bg-white p-4 rounded-xl shadow-md border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $cost['service'] }}</h3>
                                    <p class="text-sm text-gray-600">{{ $cost['description'] }}</p>
                                    <div class="flex items-center mt-2 text-sm text-gray-600">
                                        <i class="far fa-clock text-green-500 mr-2"></i>
                                        Estimasi: {{ $cost['cost'][0]['etd'] }} hari
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-green-500">
                                        Rp {{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center px-6 py-3 bg-white text-green-600 font-semibold rounded-xl
                          shadow-lg hover:bg-green-50 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
