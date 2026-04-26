<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'approved')
            ->with('category')
            ->firstOrFail();

        return view('web.articles.show', compact('article'));
    }
}