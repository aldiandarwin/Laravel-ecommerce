<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    collect([
        'Food',
        'Drinks',
        'Snacks',
        'Clothes',
        'Shoes',
        'Accessories',
        'Electronics',
    ])->each(function ($category) {
        \App\Models\Category::query()->create([
            'name' => $category,
            'slug' => str($category)->slug(),
        ]);
    });
}
}
