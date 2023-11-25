<?php

namespace App\Traits;

trait HasStocks
{
    public function inStock(): bool
    {
        return $this->stock > 0;
    }

    public function outOfStock(): bool
    {
        return ! $this->inStock();
    }

    public function lowStock(): bool
    {
        return $this->stock <= 5;
    }

    public function hasStock(): bool
    {
        return $this->stock > 0;
    }
}