<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    public $timestamps = false;

    public function subdistricts(): HasMany
    {
        return $this->hasMany(Subdistrict::class);
    }
}