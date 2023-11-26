<?php

namespace App\Services\RajaOngkir;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected mixed $baseUrl;
    protected PendingRequest $http;
    private mixed $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.key');
        $this->baseUrl = config('services.rajaongkir.base_url');
        $this->http = Http::withHeaders([
            'key' => $this->apiKey,
        ]);
    }
}