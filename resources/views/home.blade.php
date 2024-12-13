@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative"
    style="background-image: url('https://plus.unsplash.com/premium_photo-1663950995673-f4916a77ca6d?q=80&w=1975&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">

    <!-- Lapisan blur -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Konten -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">
                <i class="fas fa-shipping-fast text-green-400 mr-3"></i>
                Cek Ongkir
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                Cek ongkos kirim ke seluruh wilayah Indonesia dengan cepat dan akurat
            </p>
        </div>

        <!-- Main Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-green-500 p-6">
                <h2 class="text-2xl font-semibold text-white text-center">
                    <i class="fas fa-calculator mr-2"></i>
                    Hitung Ongkos Kirim
                </h2>
            </div>

            <!-- Card Body -->
            <div class="p-6 lg:p-8">
                <form action="{{ route('store') }}" method="POST" id="ongkirForm">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Origin Section -->
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-box-open text-green-500 text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">Asal Pengiriman</h3>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                    <select name="province_origin" id="province_origin"
                                            class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                                    <select name="city_origin" id="city_origin"
                                            class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Destination Section -->
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-map-marker-alt text-green-500 text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">Tujuan Pengiriman</h3>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten Tujuan</label>
                                    <select name="city_destination" id="city_destination"
                                            class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Berat Paket</label>
                                    <div class="relative">
                                        <input type="text" name="weight" id="weight"
                                               class="w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500 pr-16"
                                               placeholder="Masukkan berat">
                                        <div class="absolute inset-y-0 right-0 flex items-center px-4 bg-green-500 text-white rounded-r-lg">
                                            Gram
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Courier Section -->
                    <div class="mt-8 bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-truck text-green-500 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Pilih Jasa Pengiriman</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($courier as $key => $value)
                            <div class="relative">
                                <input type="checkbox" id="courier-{{ $key }}" name="courier[]"
                                       value="{{ $value->code }}" class="peer hidden">
                                <label for="courier-{{ $key }}"
                                       class="block p-4 bg-white border-2 border-gray-200 rounded-xl cursor-pointer
                                              transition-all hover:shadow-md
                                              peer-checked:border-green-500 peer-checked:bg-green-50">
                                    <div class="text-center">
                                        <i class="fas fa-shipping-fast text-3xl text-green-500 mb-2"></i>
                                        <h6 class="font-semibold text-gray-800">{{ $value->title }}</h6>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 text-center">
                        <button type="button" id="submitButton"
                                class="inline-flex items-center px-8 py-3 bg-green-500 text-white font-semibold
                                       rounded-xl shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-0.5">
                            <i class="fas fa-calculator mr-2"></i>
                            Hitung Ongkir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#province_origin, #city_origin, #city_destination').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: $(this).data('placeholder'),
            // Custom styles untuk Select2
            templateResult: formatOption,
            templateSelection: formatOption
        });

        // Custom formatting untuk options
        function formatOption(option) {
            if (!option.id) return option.text;
            return $(`<span class="text-gray-700">${option.text}</span>`);
        }

        // Load Provinces
        $.get('/provinces', function(data) {
            $('#province_origin').empty();
            $('#province_origin').append('<option value="">Pilih Provinsi</option>');
            $.each(data, function(key, value) {
                $('#province_origin').append(`<option value="${value.province_id}">${value.province}</option>`);
            });
        });

        // Load All Cities for Destination
        $.get('/cities', function(data) {
            $('#city_destination').empty();
            $('#city_destination').append('<option value="">Pilih Kota Tujuan</option>');
            $.each(data, function(key, value) {
                $('#city_destination').append(`<option value="${value.city_id}">${value.type} ${value.city_name} (${value.province})</option>`);
            });
        });

        // When Province is Selected
        $('#province_origin').on('change', function() {
            let provinceId = $(this).val();
            if(provinceId) {
                $.get(`/cities/${provinceId}`, function(data) {
                    $('#city_origin').empty();
                    $('#city_origin').append('<option value="">Pilih Kota Asal</option>');
                    $.each(data, function(key, value) {
                        $('#city_origin').append(`<option value="${value.city_id}">${value.type} ${value.city_name}</option>`);
                    });
                });
            } else {
                $('#city_origin').empty();
                $('#city_origin').append('<option value="">Pilih Kota Asal</option>');
            }
        });

        // Show error message if exists
        @if (session('error'))
            Swal.fire({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonColor: "#22c55e"
            });
        @endif
    });

    // Submit button handler
    document.getElementById("submitButton").addEventListener("click", function() {
        Swal.fire({
            title: "Konfirmasi Pengiriman",
            text: "Pastikan data yang Anda masukkan sudah benar",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#22c55e",
            cancelButtonColor: "#6b7280",
            confirmButtonText: "Ya, Hitung Sekarang",
            cancelButtonText: "Periksa Kembali"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Sedang Menghitung",
                    text: "Mohon tunggu sebentar...",
                    icon: "info",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        document.getElementById("ongkirForm").submit();
                    }
                });
            }
        });
    });
</script>

<style>
    /* Custom styles untuk Select2 */
    .select2-container--bootstrap-5 .select2-selection {
        background-color: rgba(255, 255, 255, 0.9) !important;
        border-color: rgba(209, 213, 219, 0.5) !important;
    }

    .select2-container--bootstrap-5 .select2-selection:focus {
        border-color: #22c55e !important;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.25) !important;
    }

    .select2-container--bootstrap-5 .select2-dropdown {
        background-color: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(8px);
        border-color: rgba(209, 213, 219, 0.5) !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--highlighted {
        background-color: #22c55e !important;
        color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--selected {
        background-color: #dcfce7 !important;
        color: #166534 !important;
    }

    .select2-search__field:focus {
        border-color: #22c55e !important;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.25) !important;
    }
</style>
@endpush
@endsection


