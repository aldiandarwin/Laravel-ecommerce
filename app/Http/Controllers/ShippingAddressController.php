<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingAddressRequest;
use App\Http\Resources\ShippingAddressResource;
use App\Models\City;
use App\Models\ShippingAddress;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippingAddresses = ShippingAddress::query()->where('user_id', auth()->id())->get();

        return inertia('ShippingAddress/Index', [
            'shipping_addresses' => ShippingAddressResource::collection($shippingAddresses),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('ShippingAddress/Form', [
            'shipping_address' => new ShippingAddress,
            'location' => [
                'provinces' => \App\Models\Province::query()->get()->map->only('id', 'name'),
            ],
            'page_setting' => [
                'method' => 'post',
                'url' => route('shipping-addresses.store'),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingAddressRequest $request)
    {
        $request->user()->shippingAddresses()->create([
            'province_id' => $request->province,
            'city_id' => $request->city,
            'subdistrict_id' => $request->subdistrict ?? null,
            'address' => $request->address,
            'is_default' => $request->boolean('is_default'),
        ]);

        return redirect()->route('shipping-addresses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingAddress $shippingAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingAddress $shippingAddress)
    {
        return inertia('ShippingAddress/Form', [
            'shipping_address' => $shippingAddress,
            'location' => [
                'provinces' => \App\Models\Province::query()->get()->map->only('id', 'name'),
                'cities' => City::where('province_id', $shippingAddress->province_id)->get()->map->only('id', 'name'),
                'subdistricts' => Subdistrict::where('city_id', $shippingAddress->city_id)->get()->map->only('id', 'name'),
            ],
            'page_setting' => [
                'method' => 'put',
                'url' => route('shipping-addresses.update', $shippingAddress),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingAddress $shippingAddress)
    {
        $shippingAddress->update([
            'province_id' => $request->province,
            'city_id' => $request->city,
            'subdistrict_id' => $request->subdistrict,
            'address' => $request->address,
            'is_default' => $request->boolean('is_default'),
        ]);

        if ($request->boolean('is_default')) {
            $request->user()->shippingAddresses()->where('id', '!=', $shippingAddress->id)->update([
                'is_default' => false,
            ]);
        }

        return redirect()->route('shipping-addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingAddress $shippingAddress)
    {
        $shippingAddress->delete();

        return redirect()->route('shipping-addresses.index');
    }
}
