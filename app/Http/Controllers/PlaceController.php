<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class PlaceController extends Controller
{
    public function store(Request $request)
    {
        Place::create([
            'elevation' => $request->elevation,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return to_route('elevation.render');
    }
}
