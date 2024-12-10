<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['nazev_mista', 'elevation', 'longitude', 'latitude'];
}
