<?php

namespace Database\Seeders;

use App\Contracts\RajaOngkir\LocationInterface;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(LocationInterface $location): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Province::truncate();
        $response = $location->getProvinces();
        $provinces = $response['rajaongkir']['results'];
        $this->command->getOutput()->progressStart(count($provinces));
        collect($provinces)->each(function ($item) {
            Province::create([
                'id' => $item['province_id'],
                'name' => $item['province'],
            ]);
            $this->command->getOutput()->progressAdvance();
        });
        $this->command->getOutput()->progressFinish();
    }
}
