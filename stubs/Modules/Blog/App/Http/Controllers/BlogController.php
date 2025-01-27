<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show(Blog $blog)
    {
        abort_if(! $blog->isVisible() || ! $blog->isPublished(), 404);

        return view('resources.blog.show', ['model' => $blog]);
    }
}
