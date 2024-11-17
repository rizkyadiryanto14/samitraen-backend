<?php

namespace App\Service;

use App\Models\Unit;

class UnitService
{
    public function getUnits(array $data = []) {
        $unit = Unit::orderBy('id','desc');
        return $unit;   
    }
}