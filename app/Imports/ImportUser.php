<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
           'email' => $row[0],
           'name' => $row[1],
           'password' => bcrypt($row[2]),
           'department' => $row[3],
           'location' => $row[4],
        ]);
    }
}
