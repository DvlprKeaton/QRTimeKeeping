<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    public $table = "timetable";



    protected $fillable = [
        'user_id',
        'scanned_by',
        'time_in',
        'time_out',
    ];

    public $timestamps = false;
}
