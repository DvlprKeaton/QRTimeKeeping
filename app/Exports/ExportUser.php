<?php

namespace App\Exports;

use App\Models\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return //User::select('name','email')->get();
                collect(DB::select("
                        SELECT email, name, department, location, time_in
                        FROM timetable tt, users r
                        WHERE r.id = tt.user_id"));
    }
}
