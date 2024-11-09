@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center"><h4><strong>Destination</strong></h4></div>

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
                                <td>{{ $origin['city_name'] }}</td>
                                <td>{{ $destination['city_name'] }}</td>
                                <td>{{ $weight }}gr</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($result as $courier)
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-warning text-white text-center"><h4><strong>{{ $courier[0]['name'] }}</strong></h4></div> 

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
                                        <td>{{ $cost['description'] }} ({{ $cost['service'] }})</td> 
                                        <td>
                                            @if ($cost['cost'][0]['etd'] == '') 
                                                Tidak tersedia
                                            @else
                                                {{ $cost['cost'][0]['etd'] }} Hari
                                            @endif
                                        </td>
                                        <td>Rp{{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}</td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <a href="{{ url('home') }}" class="text-decoration-none btn btn-danger">Kembali</a>

</div>
@endsection
