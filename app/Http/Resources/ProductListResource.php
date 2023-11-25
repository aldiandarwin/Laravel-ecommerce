<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
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
        'slug' => $this->slug,
        'href' => route('products.show', $this),
        'imageSrc' => $this->getPicture(),
        'imageAlt' => $this->name,
        'price' => number_format($this->price, 0, '.', '.'),
        'category' => $this->category ? [
            'name' => $this->category->name,
            'href' => route('categories.show', $this->category),
        ] : null,
    ];
}
}
