<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Subdistrict;

class LocationController extends Controller
{
    public function city(Province $province)
    {
        return City::query()
            ->where('province_id', $province->id)
            ->get()
            ->map->only('id', 'name');
    }

    public function subdistrict(City $city)
    {
        return Subdistrict::query()
            ->where('city_id', $city->id)
            ->get()
            ->map->only('id', 'name');
    }
}
