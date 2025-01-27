<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function show(Story $story)
    {
        abort_if(! $story->isVisible() || ! $story->isPublished(), 404);

        return view('resources.story.show', ['model' => $story]);
    }
}
