<?php

namespace App\Http\Controllers;

use App\Contracts\Midtrans\TransactionInterface;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Courier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $couriers = Courier::query()
            ->where('enabled', true)
            ->get()
            ->map(fn($courier) => [
                'id' => $courier->code,
                'name' => $courier->name,
                'code' => $courier->code,
            ]);

        $carts = Cart::query()
            ->whereBelongsTo(auth()->user())
            ->whereNotNull('placed_at')
            ->with('variation.product')
            ->latest()
            ->get();

        abort_if($carts->count() === 0, 404);

        $totalWeight = $request->user()->carts->sum(fn($cart) => $cart->variation->weight * $cart->quantity);
        $shippingAddress = $request->user()->defaultShippingAddress?->load('province:id,name', 'city:id,name,postal_code', 'subdistrict:id,name');

        $orderSummary = [
            'subtotal' => number_format($subtotal = $carts->sum(fn($cart) => $cart->quantity * $cart->price), 0, '.', '.'),
            'tax' => number_format($tax = taxCalculation($subtotal), 0, '.', '.'),
            'total' => number_format($subtotal + $tax, 0, '.', '.'),
        ];

        return inertia('Checkout/Index', [
            'carts' => CartResource::collection($carts),
            'couriers' => $couriers,
            'total_weight' => $totalWeight,
            'shipping_address' => $shippingAddress,
            'order_summary' => $orderSummary,
        ]);
    }

    public function create(Request $request)
    {
        Cart::query()
            ->whereBelongsTo($request->user())
            ->whereNull('placed_at')
            ->with('variation')
            ->latest()
            ->get()
            ->each(fn($cart) => $cart->update(['placed_at' => now()]));

        return to_route('checkout.index');
    }

    //     public function store(TransactionRequest $request, TransactionInterface $transactionService)
//     {
//         // Define carts
//         $carts = $request->user()->carts()->whereNotNull('placed_at')->get();

    //         // Define subtotal
//         $subtotal = $carts->sum(fn ($cart) => $cart->quantity * $cart->price);

    //         // Define total
//         $total = (int) taxCalculation($subtotal) + $subtotal;

    //         // Define shipping cost
//         $shippingCost = +str_replace('.', '', $request->service['cost']);

    //         // Define gross amount
//         $grossAmount = $total + $shippingCost;

    //         // Check if transaction exists
//         $transactionExists = Transaction::query()
//             ->whereBelongsTo($request->user(), 'customer')
//             ->whereNull('settlement_time')
//             ->latest()
//             ->firstOr(fn () => false);

    //         if ($transactionExists) {
//             return to_route('transactions.show', $transactionExists);
//         }

    //         // Define item details
//         $itemDetails = $carts->map(fn ($cart) => [
//             'id' => $cart->variation_id,
//             'price' => (int) taxCalculation($cart->price) + $cart->price,
//             'quantity' => $cart->quantity,
//             'name' => $cart->variation->product->name,
//         ]);

    //         $transaction = DB::transaction(function () use ($request, $carts, $transactionService, $itemDetails, $grossAmount, $shippingCost) {
//             // Create internal transaction
//             $transaction = $request->user()->transactions()->create([
//                 'order_id' => $orderId = 'ORD' . $request->user()->id . date('YmdHis'),
//                 'gross_amount' => $grossAmount,
//                 'shipping_information' => [
//                     ...$request->collect(['courier', 'service'])->toArray(),
//                     ...[
//                         'address' => [
//                             'detail' => $request->user()->defaultShippingAddress->address,
//                             'province' => $request->user()->defaultShippingAddress->province->name,
//                             'city' => $request->user()->defaultShippingAddress->city->name,
//                             'subdistrict' => $request->user()->defaultShippingAddress?->subdistrict?->name,
//                         ],
//                     ],
//                 ],
//                 'payment_method' => $request->payment_method,
//             ]);

    //             // Create transaction details
//             $itemDetails->each(fn ($itemDetail) => $transaction->details()->create([
//                 'variation_id' => $itemDetail['id'],
//                 'name' => $itemDetail['name'],
//                 'price' => $itemDetail['price'],
//                 'quantity' => $itemDetail['quantity'],
//             ]));

    //             // Define payment method parameter
//             $paymentMethodParameter = match ($request->payment_method['type']) {
//                 'echannel' => [
//                     'echannel' => [
//                         'bill_info1' => 'Payment For',
//                         'bill_info2' => 'Order #' . $orderId,
//                     ],
//                 ],
//                 'bank_transfer' => [
//                     'bank_transfer' => [
//                         'bank' => $request->payment_method['id'],
//                     ],
//                 ],
//                 'gopay' => [],
//             };

    //             // Parameterize transaction
//             $params = [
//                 'payment_type' => $request->payment_method['type'],
//                 'transaction_details' => [
//                     'order_id' => $orderId,
//                     'gross_amount' => $grossAmount,
//                 ],
//                 'customer_details' => [
//                     'first_name' => $request->user()->name,
//                     'email' => $request->user()->email,
//                 ],
//                 'item_details' => [
//                     ...$itemDetails->toArray(),
//                     [
//                         'id' => $request->service['id'],
//                         'price' => $shippingCost,
//                         'quantity' => 1,
//                         'name' => strtoupper($request->courier['code']) . ' ' . $request->service['name'],
//                     ],
//                 ],
//                 ...$paymentMethodParameter,
//             ];

    //             // Create transaction
//             $response = $transactionService->create($params)->json();

    //             // Define payment method information
//             $vaNumber = match ($request->payment_method['id']) {
//                 'mandiri' => [
//                     'bill_key' => $response['bill_key'],
//                     'biller_code' => $response['biller_code'],
//                 ],
//                 'bni', 'bca' => [
//                     'va_number' => $response['va_numbers'][0]['va_number'],
//                 ],
//                 'permata' => [
//                     'va_number' => $response['permata_va_number'],
//                 ],
//                 'gopay' => [
//                     'qrcode' => $response['actions'][0]['url'],
//                     'deeplink-redirect' => $response['actions'][1]['url'],
//                 ],
//                 default => null,
//             };

    //             // Update internal transaction
//             $transaction->update([
//                 'payment_method' => [...$request->payment_method, ...$vaNumber],
//                 'merchant_id' => $response['merchant_id'],
//                 'status_message' => $response['status_message'],
//                 'transaction_id' => $response['transaction_id'],
//                 'transaction_status' => $response['transaction_status'],
//                 'transaction_time' => $response['transaction_time'],
//                 'expiry_time' => $response['expiry_time'],
//             ]);

    //             $carts->each(fn ($cart) => $cart->delete());

    //             return $transaction;
//         });

    //         return to_route('transactions.show', $transaction);
//     }
// }
}
