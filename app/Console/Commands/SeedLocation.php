<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding all location from RajaOngkir API';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Start seeding couriers');
        $this->call('db:seed', ['--class' => 'CourierSeeder']);
        $this->info('=======================================');
        $this->info('Finish seeding provinces with ' . \App\Models\Courier::count() . ' rows');
        $this->info('=======================================');

        $this->info('Start seeding provinces');
        $this->call('db:seed', ['--class' => 'ProvinceSeeder']);
        $this->info('=======================================');
        $this->info('Finish seeding provinces with ' . \App\Models\Province::count() . ' rows');
        $this->info('=======================================');

        $this->info('Start seeding cities');
        $this->call('db:seed', ['--class' => 'CitySeeder']);
        $this->info('=======================================');
        $this->info('Finish seeding cities with ' . \App\Models\City::count() . ' rows');
        $this->info('=======================================');

        $this->info('Start seeding subdistricts');
        $this->call('db:seed', ['--class' => 'SubdistrictSeeder']);
        $this->info('=======================================');
        $this->info('Finish seeding subdistricts with ' . \App\Models\Subdistrict::count() . ' rows');
        $this->info('=======================================');
    }
}
