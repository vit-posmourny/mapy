<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['place_name', 'elevation', 'longitude', 'latitude'];
}
