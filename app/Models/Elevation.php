<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Elevation extends Model
{
    protected $fillable = ['longitude', 'latitude', 'elevation', 'user_id',];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
