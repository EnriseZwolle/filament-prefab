<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Contracts\View\View;


class LocationController extends Controller
{
    public function show(Location $location): View
    {
        abort_if(! $location->isVisible(), 404);

        return view('resources.location.show', ['model' => $location]);
    }
}
