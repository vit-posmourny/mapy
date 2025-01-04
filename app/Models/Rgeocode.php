<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rgeocode extends Model
{
    protected $fillable = ['label', 'location', 'name', 'latitude', 'longitude', 'regional_address', 'regional_street', 
                            'regional_municipality_part_1', 'regional_municipality_part_2', 'regional_municipality', 
                            'regional_region_1', 'regional_region_2',  'regional_country', 'isoCode', 'zip'];
}
