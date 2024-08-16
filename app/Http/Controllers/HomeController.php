<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Courier;
use App\Models\Province;
use Illuminate\Http\Request;
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
        $province = $this->getProvince();
        $courier = $this->getCourier();
        return view('home',compact('province', 'courier'));
    }

    public function store(Request $request){
        $courier = $request->input('courier');

        if ($courier) {

            $data = [
                'origin' => $this->getCity($request->city_origin),
                'destination' => $this->getCity($request->city_destination),
                'weight' => 1300,
                'result' => []
            ];

            foreach ($courier as $value) {
                $ongkir = RajaOngkir::ongkosKirim([
                    'origin' => $data['origin']->code,
                    'destination' => $data['destination']->code,
                    'weight' => $data['weight'],
                    'courier' => $value
                ])->get();

                $data['result'][] = $ongkir;
            }

            return view('costs')->with($data);
        }

        return redirect()->back();
    }


    public function getProvince(){
        return Province::pluck('title','code');
    }

    public function getCities($id){
        return City::where('province_code',$id)
        ->pluck('title','code');
        
    }

    public function getCity($id){
        return City::where('code', $id)->first();
    }

    public function searchCities(Request $request){
        $search = $request->search;

        if (empty($search)) {
            $cities = City::orderBy('title', 'asc')
                ->select('id', 'title')
                ->limit(5)
                ->get();
        } else {
            $cities = City::orderBy('title', 'asc')
                ->where('title', 'LIKE', '%' . $search . '%')
                ->select('id', 'title')
                ->limit(5)
                ->get();
        }

        $response = [];

        foreach ($cities as $city) {
            $response[] = [
                'id' => $city->id,
                'text' => $city->title,
            ];
        }

        return response()->json($response);
    }

    public function getCourier(){
        return Courier::all();
    }

}
