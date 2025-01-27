<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/nieuws/{newsItem:slug}', [NewsController::class, 'show'])->name('news.show');
