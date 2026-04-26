<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleLike;
use Illuminate\Support\Facades\Schema;

class LikedArticleController extends Controller
{
    public function index()
    {
        $likedArticles = collect();

        if (Schema::hasTable('article_likes')) {
            $likedArticles = ArticleLike::with('article.category')
                ->where('user_id', auth()->id())
                ->whereHas('article', fn ($q) => $q->where('status', 'approved'))
                ->latest()
                ->get();
        }

        return view('subscriber.liked-articles.index', compact('likedArticles'));
    }

    public function toggle(Article $article)
    {
        if ($article->status !== 'approved') {
            abort(404);
        }

        $articleLike = ArticleLike::where('user_id', auth()->id())
            ->where('article_id', $article->id)
            ->first();

        if ($articleLike) {
            $articleLike->delete();

            return back()->with('success', 'Article removed from liked articles.');
        }

        ArticleLike::firstOrCreate([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
        ]);

        return back()->with('success', 'Article liked successfully.');
    }
}
