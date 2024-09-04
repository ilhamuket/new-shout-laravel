<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiUrl = 'https://api.rajaongkir.com/starter';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
    }

    protected function get($endpoint, $params = [])
    {
        $response = Http::withHeaders([
            'Key' => $this->apiKey,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->get("{$this->apiUrl}/{$endpoint}", $params);

        if ($response->failed()) {
            throw new \Exception('API request failed: ' . $response->status() . ' - ' . $response->body());
        }

        return $response->json();
    }

    protected function post($endpoint, $params = [])
    {
        $response = Http::withHeaders([
            'Key' => $this->apiKey,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post("{$this->apiUrl}/{$endpoint}", $params);

        if ($response->failed()) {
            throw new \Exception('API request failed: ' . $response->status() . ' - ' . $response->body());
        }

        return $response->json();
    }




    public function getProvinces()
    {
        return $this->get('province');
    }

    public function getCities($provinceId)
    {
        return $this->get('city', ['province' => $provinceId]);
    }

    public function getSubdistricts($cityId)
    {
        return $this->get('subdistrict', ['city' => $cityId]);
    }

    public function getCost($origin, $destination, $weight, $courier)
    {
        $params = [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ];

        return $this->post('cost', $params);
    }

    public function getCouriers()
    {
        return $this->get('courier');
    }

    public function getProvincesWithDetails()
    {
        return $this->get('province');
    }

    public function getCitiesByProvince($provinceId)
    {
        return $this->get('city', ['province' => $provinceId]);
    }

    public function getSubdistrictsByCity($cityId)
    {
        return $this->get('subdistrict', ['city' => $cityId]);
    }
}
