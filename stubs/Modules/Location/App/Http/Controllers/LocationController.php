<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Location;


class LocationController extends Controller
{
    public function show(Location $location)
    {
        abort_if(! $location->isVisible(), 404);

        return view('resources.location.show', ['model' => $location]);
    }
}
