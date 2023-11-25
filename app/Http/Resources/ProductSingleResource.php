<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSingleResource extends JsonResource
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
        'name' => $this->name,
        'href' => route('products.show', $this),
        'imageSrc' => $this->getPicture(600),
        'imageAlt' => $this->name,
        'description' => $this->description,
        'price' => number_format($this->price, 0, '.', '.'),
        'category' => $this->category ? [
            'name' => $this->category->name,
            'href' => route('categories.show', $this->category),
        ] : null,

        'variations' => $this->variations
            ->groupBy('attribute_1')
            ->map(fn ($item, $key) => VariationResource::collection($item))->toArray(),
    ];
}
}
