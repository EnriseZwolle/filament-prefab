<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/locaties/{location:slug}', [LocationController::class, 'show'])->name('location.show');
