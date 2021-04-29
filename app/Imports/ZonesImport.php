<?php

namespace App\Imports;

use App\Models\Zone;
use Maatwebsite\Excel\Concerns\ToModel;
use Str;

class ZonesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Zone([
            'name'  => $row[0],
            'slug'  => Str::slug($row[0],'-'),
            'phone' => $row[1],
            'email' => $row[2],
        ]);
    }
}
