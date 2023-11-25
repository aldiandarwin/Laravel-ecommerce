<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    public function variations(): HasMany
{
    return $this->hasMany(Variation::class);
}
 public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getPicture($size = 400): string
    {
        return $this->picture !== null ? Storage::url($this->picture) : 'https://placehold.co/' . $size . '/000000/FFFFFF/?font=source-sans-pro&text=' . $this->name;
    }
}
