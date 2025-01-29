<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function show(Service $service): View
    {
        abort_if(! $service->isVisible(), 404);

        return view('resources.service.show', ['model' => $service]);
    }
}
