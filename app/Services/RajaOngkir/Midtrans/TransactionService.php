<?php

namespace App\Services\Midtrans;

use App\Contracts\Midtrans\TransactionInterface;
use App\Models\Transaction;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class TransactionService extends MidtransService implements TransactionInterface
{
    /**
     * @param $params
     * Create transaction
     */
    public function create($params): PromiseInterface|Response
    {
        return $this->http->post($this->baseUrl . '/charge', $params);
    }

    /*
     * @param $orderId
     * Cancel transaction
     */
    public function cancel($orderId): void
    {
        $this->http->post($this->baseUrl . '/' . $orderId . '/cancel');
    }

    /**
     * @param $orderId
     * Get status of transaction
     */
    public function status($orderId): PromiseInterface|Response
    {
        return $this->http->get($this->baseUrl . '/' . $orderId . '/status');
    }

    public function hasValidSignature(Request $request, $grossAmount): bool
    {
        $signature = hash('sha512', $request->order_id . $request->status_code . $grossAmount . '.00' . $this->apiKey);

        return $request->signature_key === $signature;
    }
}
