<?php

namespace App\Service;

use App\Models\Unit;
use Exception;

class UnitService
{
    public function getUnits(array $data = [])
    {
        $unit = Unit::with('wilayah', 'laporan_kebakaran')->orderBy('id', 'desc');
        return $unit;
    }

    public function getUnitByField($field, $value)
    {
        $unit = Unit::where($field, $value)->first();
        if (!$unit) {
            throw new Exception('Unit not found');
        }
        return $unit;
    }

    public function createUnit(array $data)
    {
        $unit = Unit::create($data);
        return $unit;
    }

    public function updateUnit(Unit $unit, array $data)
    {
        $unit->update($data);
        return $unit;
    }

    public function deleteUnit(Unit $unit)
    {
        if ($unit->laporan_kebakaran()->count() > 0) {
            throw new Exception('Unit sedang digunakan, tidak dapat dihapus');
        }
        $unit->delete();
    }
}
