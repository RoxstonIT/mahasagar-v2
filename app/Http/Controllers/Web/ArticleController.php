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
            ->with('category', 'creator')
            ->firstOrFail();

        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('status', 'approved')
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('web.article', compact('article', 'relatedArticles'));
    }
}