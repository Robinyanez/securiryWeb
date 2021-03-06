<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Str;

class ClientsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'name'          => $row[0],
            'slug'          => Str::slug($row[0],'-'),
            'lat'          => $row[1],
            'lng'          => $row[2],
            'country_id'    => $row[3],
            'zone_id'    => $row[4],
        ]);
    }
}
