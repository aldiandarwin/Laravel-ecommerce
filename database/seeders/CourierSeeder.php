<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    collect([
        ['name' => 'Jalur Nugraha Ekakurir', 'code' => 'jne', 'enabled' => true],
        ['name' => 'Pos Indonesia', 'code' => 'pos', 'enabled' => false],
        ['name' => 'Citra Van Titipan Kilat', 'code' => 'tiki', 'enabled' => true],
        ['name' => 'ID Express', 'code' => 'ide', 'enabled' => true],
        ['name' => 'SiCepat Express', 'code' => 'sicepat', 'enabled' => true],
        ['name' => 'J&T Express', 'code' => 'j&t', 'enabled' => false],
        ['name' => 'Ninja Xpress', 'code' => 'ninja', 'enabled' => true],
    ])->each(fn ($courier) => \App\Models\Courier::create($courier));
}
}
