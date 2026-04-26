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

        $approvedComments = $article->comments()
            ->where('status', 'approved')
            ->with('user')
            ->latest()
            ->get();

        $isSaved = false;
        $isLiked = false;

        if (
            auth()->check() &&
            auth()->user()->hasRole('reader') &&
            auth()->user()->hasVerifiedEmail()
        ) {
            $isSaved = $article->savedByUsers()
                ->where('users.id', auth()->id())
                ->exists();

            $isLiked = $article->likedByUsers()
                ->where('users.id', auth()->id())
                ->exists();
        }

        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('status', 'approved')
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('web.article', compact('article', 'relatedArticles', 'approvedComments', 'isSaved', 'isLiked'));
    }
}
