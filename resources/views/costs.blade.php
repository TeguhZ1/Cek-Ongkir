@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Informasi Kota Asal dan Kota Tujuan -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Destination</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kota/Kab Asal</th>
                                <th>Kota/Kab Tujuan</th>
                                <th>Berat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $origin['city_name'] }}</td> <!-- Pastikan properti ini sesuai dengan data API -->
                                <td>{{ $destination['city_name'] }}</td> <!-- Pastikan properti ini sesuai dengan data API -->
                                <td>{{ $weight }}gr</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Ongkos Kirim dari Masing-Masing Kurir -->
    @foreach ($result as $courier)
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $courier[0]['name'] }}</div> <!-- Nama Kurir -->

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th>Estimasi Hari</th>
                                    <th>Ongkir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courier[0]['costs'] as $cost)
                                    <tr>
                                        <td>{{ $cost['description'] }} ({{ $cost['service'] }})</td> <!-- Nama layanan -->
                                        <td>
                                            @if ($cost['cost'][0]['etd'] == '') 
                                                Tidak tersedia
                                            @else
                                                {{ $cost['cost'][0]['etd'] }} Hari
                                            @endif
                                        </td> <!-- Estimasi hari pengiriman -->
                                        <td>Rp{{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}</td> <!-- Ongkos kirim -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection
