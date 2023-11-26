<?php

namespace App\Contracts\RajaOngkir;

use App\Models\City;
use App\Models\Province;

interface LocationInterface
{
    public function getProvinces();

    public function getCities(Province $province);

    public function getSubdistrict(City $city);
}
