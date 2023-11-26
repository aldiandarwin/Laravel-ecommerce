<?php

namespace App\Services\RajaOngkir;

use App\Contracts\RajaOngkir\CostInterface;

class CostService extends RajaOngkirService implements CostInterface
{
    public function get($origin, $destination, $weight, $courier, $originType, $destinationType)
    {
        $response = $this->http->post($this->baseUrl . '/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
            'originType' => $originType,
            'destinationType' => $destinationType,
        ]);

        return $response->json();
    }
}
