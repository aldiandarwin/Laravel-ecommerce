<?php

namespace App\Contracts\Midtrans;

use Illuminate\Http\Request;

interface TransactionInterface
{
    public function create($params);

    public function cancel($orderId);

    public function status($orderId);

    public function hasValidSignature(Request $request, $grossAmount): bool;
}
