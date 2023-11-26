<?php

namespace Database\Seeders;

use App\Contracts\RajaOngkir\LocationInterface;
use App\Models\Province;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(LocationInterface $location): void
    {
        Province::get()->each(function ($province) use ($location) {
            $response = $location->getCities($province);
            $cities = collect($response['rajaongkir']['results']);
            $this->command->getOutput()->progressStart(count($cities));
            $cities->each(function ($city) use ($province) {
                $province->cities()->create([
                    'id' => $city['city_id'],
                    'name' => $city['city_name'],
                    'type' => $city['type'],
                    'postal_code' => $city['postal_code'],
                ]);
                $this->command->getOutput()->progressAdvance();
            });
            $this->command->getOutput()->progressFinish();
        });
    }
}
