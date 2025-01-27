<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\NewsItem;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show(NewsItem $newsItem)
    {
        abort_if(! $newsItem->isVisible() || ! $newsItem->isPublished(), 404);

        return view('resources.news.show', ['model' => $newsItem]);
    }
}
