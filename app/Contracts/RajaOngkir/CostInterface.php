<?php

namespace App\Contracts\RajaOngkir;

interface CostInterface
{
    public function get($origin, $destination, $weight, $courier, $originType, $destinationType);
}
