<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'variation_id' => $this->variation_id,
        'quantity' => $qty = $this->quantity,
        'price' => number_format($this->price * $qty, 0, '.', '.'),
        'variation' => new CartVariationResource($this->variation->load('product.category')),
    ];
}
}
