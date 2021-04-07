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
            'role'      => $row[1],
            'puesto'    => $row[2],
            'cedula'    => $row[3],
            'password'  => Hash::make($row[4]),
        ]);
    }
}
