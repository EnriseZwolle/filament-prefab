<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class StoryController extends Controller
{
    public function show(Story $story): View
    {
        abort_if(! $story->isVisible() || ! $story->isPublished(), 404);

        return view('resources.story.show', ['model' => $story]);
    }
}
