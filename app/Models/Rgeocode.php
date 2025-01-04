<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rgeocode extends Model
{
    protected $fillable = ['label', 'location', 'name', 'lat', 'lon', 'regional.address', 'regional.street', 
                            'regional.municipality_part', 'regional.municipality', 'regional.region.4', 
                            'regional.region.5',  'regional.country', 'isoCode', 'zip'];
}
