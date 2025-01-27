<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Service;

class ServiceController extends Controller
{
    public function show(Service $service)
    {
        abort_if(! $service->isVisible(), 404);

        return view('resources.service.show', ['model' => $service]);
    }
}
