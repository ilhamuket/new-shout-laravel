<?php

namespace Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RajaOngkirService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShipmentController extends Controller
{
    protected $rajaOngkir;

    public function __construct(RajaOngkirService $rajaOngkir)
    {
        $this->rajaOngkir = $rajaOngkir;
    }

    public function getProvinces()
    {
        $provinces = $this->rajaOngkir->getProvinces();
        return response()->json($provinces);
    }

    public function getCitiesByProvince(Request $request)
    {
        $provinceId = $request->input('province_id');
        $cities = $this->rajaOngkir->getCities($provinceId);
        return response()->json($cities);
    }

    public function getSubdistrictsByCity(Request $request)
    {
        $cityId = $request->input('city_id');
        $subdistricts = $this->rajaOngkir->getSubdistricts($cityId);
        return response()->json($subdistricts);
    }

    public function getShippingCost(Request $request)
    {
        try {
            $origin = "23";
            $destination = $request->input('destination');
            $weight = $request->input('weight');
            $courier = $request->input('courier');


            if (empty($destination) || empty($weight) || empty($courier)) {
                return response()->json(['error' => 'Semua field harus diisi.'], 400);
            }


            if ($weight <= 0 || $weight > 30000) {
                return response()->json(['error' => 'Berat harus antara 1 gram dan 30.000 gram.'], 400);
            }


            $cost = $this->rajaOngkir->getCost($origin, $destination, $weight, $courier);


            if (isset($cost->rajaongkir->status->code) && $cost->rajaongkir->status->code != 200) {
                return response()->json([
                    'error' => $cost->rajaongkir->status->description
                ], $cost->rajaongkir->status->code);
            }


            return response()->json($cost);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Terjadi kesalahan saat mengambil data ongkir. Silakan coba lagi nanti.',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function getCouriers()
    {
        $couriers = [
            ['courier_id' => 'jne', 'courier_name' => 'JNE'],
            ['courier_id' => 'tiki', 'courier_name' => 'TIKI'],
            ['courier_id' => 'pos', 'courier_name' => 'POS'],
        ];

        return response()->json(['rajaongkir' => ['results' => $couriers]]);
    }


    public function index()
    {
        return view('general::shipment.index');
    }

}
