<?php

namespace App\Imports;

use App\Models\Puesto;
use Maatwebsite\Excel\Concerns\ToModel;
use Str;

class PuestosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Puesto([
            'name'  => $row[0],
            'slug'  => Str::slug($row[0],'-'),
        ]);
    }
}
