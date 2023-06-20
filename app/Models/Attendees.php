<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{
    use HasFactory;

    public $table = "attendees";



    protected $fillable = [
        'user_id',
        'attend',
        'confirmed_at',
    ];

    public $timestamps = false;
}
