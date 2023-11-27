<?php

namespace App\Services\Midtrans;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class MidtransService
{
    protected mixed $baseUrl;
    protected PendingRequest $http;

    protected mixed $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.midtrans.server_key');
        $this->baseUrl = config('services.midtrans.base_url');
        $this->http = Http::withBasicAuth($this->apiKey . ':', '');
    }
}
