<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
