<?php

namespace App\Http\Controllers;

use Log;
use App\Models\City;
use GuzzleHttp\Client;
use App\Models\Courier;
use App\Models\History;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $province = $this->getProvinces();
        $courier = $this->getCourier();
        return view('home',compact('province', 'courier'));
    }

    public function store(Request $request){
        $courier = $request->input('courier');
        $weight = $request->input('weight');
        $apiKey = env('RAJAONGKIR_API_KEY'); 
        $client = new Client();
    
        if ($courier) {
            $originResponse = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
                'query' => ['id' => $request->city_origin],
                'headers' => ['key' => $apiKey]
            ]);
            $originData = json_decode($originResponse->getBody(), true);
            $originCity = $originData['rajaongkir']['results'];
    
            $destinationResponse = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
                'query' => ['id' => $request->city_destination],
                'headers' => ['key' => $apiKey]
            ]);
            $destinationData = json_decode($destinationResponse->getBody(), true);
            $destinationCity = $destinationData['rajaongkir']['results'];
    
            $data = [
                'origin' => $originCity,  
                'destination' => $destinationCity, 
                'weight' => $weight,
                'result' => []
            ];
    
            foreach ($courier as $value) {
                $ongkirResponse = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
                    'form_params' => [
                        'origin' => $data['origin']['city_id'],
                        'destination' => $data['destination']['city_id'],
                        'weight' => $data['weight'],
                        'courier' => $value
                    ],
                    'headers' => ['key' => $apiKey]
                ]);
    
                $ongkir = json_decode($ongkirResponse->getBody(), true);
                $data['result'][] = $ongkir['rajaongkir']['results'];
    
            }
    
            return view('costs')->with($data);
        }
    
        return redirect()->back();
    }


    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get('https://api.rajaongkir.com/starter/province');

        if ($response->successful()) {
            return response()->json($response->json()['rajaongkir']['results']);
        } else {
            return response()->json(['error' => 'Failed to fetch data'], $response->status());
        }
    }




    public function getCities($province_id)
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $province_id,
        ]);

        if ($response->successful()) {
            return response()->json($response->json()['rajaongkir']['results']);
        } else {
            return response()->json(['error' => 'Failed to fetch data'], $response->status());
        }
    }

    public function getCity($id)
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY'),
        ])->get("https://api.rajaongkir.com/starter/city?id=$id");

        if ($response->successful()) {
            return $response->json()['rajaongkir']['results'];
        }

        return null;
    }

    public function searchCities(Request $request)
    {
        $apiKey = env('RAJAONGKIR_API_KEY');
        $search = $request->search;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => $apiKey
            ]
        ]);

        $cities = json_decode($response->getBody(), true)['rajaongkir']['results'];

        $filteredCities = collect($cities)->filter(function ($city) use ($search) {
            return empty($search) || stripos($city['city_name'], $search) !== false;
        })->map(function ($city) {
            return [
                'id' => $city['city_id'],
                'text' => $city['city_name']
            ];
        })->values();

        return response()->json($filteredCities);
    }

    public function getCourier(){
        return Courier::all();
    }

}
