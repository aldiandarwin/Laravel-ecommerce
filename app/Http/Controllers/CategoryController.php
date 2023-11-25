<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductListResource;

class CategoryController extends Controller
{
    //

    public function show(Category $category)
{
    $products = Product::query()
        ->whereBelongsTo($category)
        ->latest()
        ->paginate(12);

    return inertia('Products/Index', [
        'title' => "Kategori {$category->name}",
        'products' => ProductListResource::collection($products)->additional([
            'meta' => ['has_pages' => $products->hasPages()],
        ]),
    ]);
}
}
