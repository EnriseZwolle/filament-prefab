<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function show(Blog $blog): View
    {
        abort_if(! $blog->isVisible() || ! $blog->isPublished(), 404);

        return view('resources.blog.show', ['model' => $blog]);
    }
}
