<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run(): void
{
    collect([
        [
            'name' => $name = 'Nike Sunray Adjust 6',
            'slug' => str($name)->slug(),
            'description' => "Made for those mega-fun beach days. Maybe swimming classes at the pool. Or you just need an easy slip-on to play under the sun. The Nike Sunray Adjust 6 is super plush when the warm weather hits. The edges help keep your feet contained when you play—we don't like slipping! Also, what's easier than a strap closure? Staying secure will be the least of your worries.",
            'category_id' => Category::where('slug', 'shoes')->value('id'),
            'price' => 500000,
        ],
        [
            'name' => $name = 'Sepatu Pureboost 22',
            'slug' => str($name)->slug(),
            'description' => 'Kamu tidak perlu berlari jauh untuk merasakan manfaat olahraga. Dengan sepatu adidas ini, hanya butuh beberapa kilometer untuk mendapatkan suasana hati yang cerah. Didesain untuk aktivitas lari jarak pendek, dengan midsole BOOST yang memberikan pengembalian energi luar biasa dalam setiap langkah. Outsole Stretchweb memberikan fleksibilitas secara alami untuk sesi lari yang penuh energi, dan material Karet Continental™ menghasilkan traksi yang luar biasa.',
            'category_id' => Category::where('slug', 'shoes')->value('id'),
            'price' => 500000,
        ],
        [
            'name' => $name = str('Lengan pendek boxy fit')->title(),
            'slug' => str($name)->slug(),
            'description' => 'Kaus lengan pendek boxy fit bergambar. Bahan katun. Kerah bulat. Lengan pendek. Bergambar di bagian depan. Potongan boxy fit. Tinggi model: 189 cm. Lengan model: 64 cm. Ukuran L',
            'category_id' => Category::where('slug', 'clothes')->value('id'),
            'price' => 300000,
        ],
        [
            'name' => $name = str('aeroready designed to move')->title(),
            'slug' => str($name)->slug(),
            'description' => 'Kaus sport tee aeroready designed to move. Bahan katun. Kerah bulat. Lengan pendek. Bergambar di bagian depan. Potongan boxy fit. Tinggi model: 189 cm. Lengan model: 64 cm. Ukuran M',
            'category_id' => Category::where('slug', 'clothes')->value('id'),
            'price' => 250000,
        ],

        [
            'name' => $name = str('Nasi Padang Paling Nikmat')->title(),
            'slug' => str($name)->slug(),
            'description' => 'Disajikan dengan rendang, ayam pop, gulai ikan, atau telur dadar, lalu disiram dengan kuah gulai yang lezat, membuat nasi Padang punya cita rasa tersendiri.',
            'category_id' => Category::where('slug', 'food')->value('id'),
            'price' => 27000,
        ],
    ])->each(function ($product) {
        \App\Models\Product::create($product);
    });
}
}
