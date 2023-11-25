<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
    //  * @return array<string, mixed>
     */
   public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'attribute_1' => $this->attribute_1,
        'attribute_2' => $this->attribute_2,
        'stock' => $this->stock,
        'price' => number_format($this->price, 0, '.', '.'),
        'inStock' => $this->stock > 0,
    ];
}
}
