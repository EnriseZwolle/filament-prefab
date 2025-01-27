<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class NewsController extends Controller
{
    public function show(NewsItem $newsItem): View
    {
        abort_if(! $newsItem->isVisible() || ! $newsItem->isPublished(), 404);

        return view('resources.news.show', ['model' => $newsItem]);
    }
}
