<?php

namespace App\Services\RajaOngkir;

use App\Contracts\RajaOngkir\LocationInterface;
use App\Models\City;
use App\Models\Province;

class LocationService extends RajaOngkirService implements LocationInterface
{
    public function getProvinces()
    {
        $response = $this->http->get($this->baseUrl . '/province');

        return $response->json();
    }

    public function getCities(Province $province)
    {
        $response = $this->http->get($this->baseUrl . '/city', [
            'province' => $province->id,
        ]);

        return $response->json();
    }

    public function getSubdistrict(City $city)
    {
        $response = $this->http->get($this->baseUrl . '/subdistrict', [
            'city' => $city->id,
        ]);

        return $response->json();
    }
}
