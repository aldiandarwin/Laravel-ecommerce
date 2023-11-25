<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductSingleResource;

class ProductController extends Controller
{
    //

    public function index()
{
    $products = Product::query()
        ->latest()
        ->paginate(12);

    return inertia('Products/Index', [
        'title' => 'Products',
        'products' => ProductListResource::collection($products)->additional([
            'meta' => ['has_pages' => $products->hasPages()],
        ]),
    ]);
}

public function show(Product $product)
{
    return inertia('Products/Show', [
        'product' => ProductSingleResource::make($product->load('category')),
    ]);
}
}
