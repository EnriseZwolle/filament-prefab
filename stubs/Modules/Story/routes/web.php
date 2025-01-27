<?php

use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/verhalen/{story:slug}', [StoryController::class, 'show'])->name('story.show');
