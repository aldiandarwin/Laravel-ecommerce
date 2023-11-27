<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\RajaOngkir\CostInterface;
use App\Http\Resources\CostResource;


class CheckPostageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CostInterface $cost)
{
    $request->validate([
        'destination' => ['required'],
        'courier' => ['required'],
        'destination_type' => ['required', 'in:city,subdistrict']
    ]);

    $response = $cost->get(
        origin: config('services.rajaongkir.origin'),
        destination: $request->destination,
        weight: $request->weight,
        courier: $request->courier,
        originType: config('services.rajaongkir.origin_type'),
        destinationType: $request->destination_type
    );
    $costs = collect($response['rajaongkir']['results'][0]['costs']);

    return CostResource::collection($costs);
}
}
