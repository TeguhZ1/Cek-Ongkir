<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use Illuminate\Support\Facades\Http;
use App\Models\ShippingHistory;

class HomeController extends Controller
{
    protected $apiKey;

    public function __construct()
    {
        $this->middleware('auth');
        $this->apiKey = config('services.rajaongkir.key');
        \Log::info('RajaOngkir API Key:', ['key' => $this->apiKey]);
    }

    public function index()
    {
        $courier = Courier::all();
        return view('home', compact('courier'));
    }

    public function getProvinces()
    {
        try {
            \Log::info('Fetching provinces...');
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->get('https://api.rajaongkir.com/starter/province');

            \Log::info('RajaOngkir Raw Response:', ['response' => $response->body()]);

            $data = $response->json();
            \Log::info('RajaOngkir JSON Response:', $data);

            return response()->json($data['rajaongkir']['results']);
        } catch (\Exception $e) {
            \Log::error('RajaOngkir Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $provinceId
        ]);

        return response()->json($response['rajaongkir']['results']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_origin' => 'required',
            'city_destination' => 'required',
            'weight' => 'required|numeric',
            'courier' => 'required|array'
        ]);

        $results = [];
        foreach ($request->courier as $courier) {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $request->city_origin,
                'destination' => $request->city_destination,
                'weight' => $request->weight,
                'courier' => $courier
            ]);

            if ($response->successful()) {
                $result = $response['rajaongkir']['results'][0];
                foreach ($result['costs'] as $cost) {
                    ShippingHistory::create([
                        'user_id' => auth()->id(),
                        'origin_city' => $request->city_origin,
                        'destination_city' => $request->city_destination,
                        'weight' => $request->weight,
                        'courier' => $result['name'],
                        'service' => $cost['service'],
                        'cost' => $cost['cost'][0]['value'],
                        'etd' => $cost['cost'][0]['etd']
                    ]);
                }
                $results[] = $result;
            }
        }

        return view('costs', [
            'results' => $results,
            'weight' => $request->weight
        ]);
    }

    public function getAllCities()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get('https://api.rajaongkir.com/starter/city');

        return response()->json($response['rajaongkir']['results']);
    }

    public function history()
    {
        $histories = ShippingHistory::where('user_id', auth()->id())
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        return view('history', compact('histories'));
    }

    public function clearHistory()
    {
        ShippingHistory::where('user_id', auth()->id())->delete();
        return redirect()->route('history')->with('success', 'Riwayat berhasil dihapus');
    }
}
