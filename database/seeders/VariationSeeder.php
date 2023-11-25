<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

public function run(): void
{
    collect([
        ['attribute_1' => 'Biru', 'attribute_2' => '40', 'price' => 510000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => '41', 'price' => 510000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => '42', 'price' => 510000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => '43', 'price' => 530000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => '44', 'price' => 540000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => '45', 'price' => 550000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => '40', 'price' => 510000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => '41', 'price' => 510000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => '42', 'price' => 520000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => '43', 'price' => 530000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => '44', 'price' => 550000, 'stock' => rand(70, 100)],
    ])->each(fn ($variation) => Product::query()->find(1)->variations()->create($variation));

    collect([
        ['attribute_1' => 'Biru', 'attribute_2' => 39, 'price' => 500000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => 40, 'price' => 515000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => 41, 'price' => 515000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Biru', 'attribute_2' => 42, 'price' => 515000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hijau', 'attribute_2' => 40, 'price' => 520000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hijau', 'attribute_2' => 41, 'price' => 520000, 'stock' => 0],
        ['attribute_1' => 'Hijau', 'attribute_2' => 42, 'price' => 520000, 'stock' => 0],
        ['attribute_1' => 'Hijau', 'attribute_2' => 43, 'price' => 520000, 'stock' => rand(70, 100)],
    ])->each(fn ($variation) => Product::query()->find(2)->variations()->create($variation));

    collect([
        ['attribute_1' => 'Hitam', 'attribute_2' => 'S', 'price' => 300000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => 'M', 'price' => 310000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => 'L', 'price' => 320000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => 'XL', 'price' => 340000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => 'XXL', 'price' => 360000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Putih', 'attribute_2' => 'S', 'price' => 315000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Putih', 'attribute_2' => 'M', 'price' => 315000, 'stock' => 0],
        ['attribute_1' => 'Putih', 'attribute_2' => 'L', 'price' => 325000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Putih', 'attribute_2' => 'XL', 'price' => 335000, 'stock' => rand(70, 100)],
    ])->each(fn ($variation) => Product::query()->find(3)->variations()->create($variation));

    collect([
        ['attribute_1' => 'Hitam', 'attribute_2' => 'S', 'price' => 260000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => 'M', 'price' => 270000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => 'L', 'price' => 270000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Hitam', 'attribute_2' => 'XL', 'price' => 290000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Putih', 'attribute_2' => 'S', 'price' => 280000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Putih', 'attribute_2' => 'L', 'price' => 280000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Putih', 'attribute_2' => 'XL', 'price' => 270000, 'stock' => 0],
        ['attribute_1' => 'Putih', 'attribute_2' => 'XXL', 'price' => 280000, 'stock' => rand(70, 100)],
    ])->each(fn ($variation) => Product::query()->find(4)->variations()->create($variation));

    collect([
        ['attribute_1' => 'Ayam', 'attribute_2' => 'Dada Atas', 'price' => 27000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Ayam', 'attribute_2' => 'Paha Atas', 'price' => 26000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Ayam + Telur', 'attribute_2' => 'Small', 'price' => 31000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Ayam + Telur', 'attribute_2' => 'Medium', 'price' => 31000, 'stock' => rand(70, 100)],
        ['attribute_1' => 'Ayam + Telur', 'attribute_2' => 'Large', 'price' => 32000, 'stock' => rand(70, 100)],
    ])->each(fn ($variation) => Product::query()->find(5)->variations()->create($variation));
}
}
