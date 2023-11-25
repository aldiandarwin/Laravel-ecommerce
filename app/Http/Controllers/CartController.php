<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;
use App\Models\Variation;

class CartController extends Controller
{
public function index()
{
    $carts = Cart::query()
        ->whereBelongsTo(auth()->user())
        ->whereNull('placed_at')
        ->with('variation.product')
        ->latest()
        ->get();

    $orderSummary = [
        'subtotal' => number_format($subtotal = $carts->sum(fn ($cart) => $cart->quantity * $cart->price), 0, '.', '.'),
        'tax' => number_format($tax = taxCalculation($subtotal), 0, '.', '.'),
        'total' => number_format($subtotal + $tax, 0, '.', '.'),
    ];

    $resource = CartResource::collection($carts);

    return inertia('Cart/Index', [
        'carts' => $resource,
        'orderSummary' => $orderSummary,
    ]);
}

public function store(Request $request)
{
    $variation = Variation::findOrFail($request->variation_id);
    $existsQty = $request->user()->carts()->where('variation_id', $variation->id)->value('quantity');
    $request->user()->carts()->whereNull('placed_at')->updateOrCreate(
        ['variation_id' => $variation->id],
        [
            'variation_id' => $variation->id,
            'quantity' => $request->quantity + $existsQty,
            'price' => $variation->price,
        ]
    );

    return to_route('carts.index');
}

public function update(Request $request, Cart $cart)
{
    $cart->update($request->only('quantity'));

    return to_route('carts.index');
}

public function destroy(Cart $cart)
{
    $cart->delete();

    return back();
}
}
