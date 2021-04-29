<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Str;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'      => $row[0],
            'slug'      => Str::slug($row[0],'-'),
            'cedula'    => $row[1],
            'password'  => Hash::make($row[2]),
            'client_id' => $row[3],
            'puesto_id' => $row[4],
            'cargo_id' => $row[5],
        ]);
    }
}
