<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this['service'],
        'name' => $this['description'],
        'cost' => number_format($this['cost'][0]['value'], 0, '.', '.'),
        'etd' => $this['cost'][0]['etd'],
    ];
}
}
