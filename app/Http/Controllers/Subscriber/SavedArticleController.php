<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\SavedArticle;
use Illuminate\Support\Facades\Schema;

class SavedArticleController extends Controller
{
    public function index()
    {
        $savedArticles = collect();

        if (Schema::hasTable('saved_articles')) {
            $savedArticles = SavedArticle::with('article.category')
                ->where('user_id', auth()->id())
                ->whereHas('article', fn ($q) => $q->where('status', 'approved'))
                ->latest()
                ->get();
        }

        return view('subscriber.saved-articles.index', compact('savedArticles'));
    }

    public function toggle(Article $article)
    {
        if ($article->status !== 'approved') {
            abort(404);
        }

        $savedArticle = SavedArticle::where('user_id', auth()->id())
            ->where('article_id', $article->id)
            ->first();

        if ($savedArticle) {
            $savedArticle->delete();

            return back()->with('success', 'Article removed from saved articles.');
        }

        SavedArticle::firstOrCreate([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
        ]);

        return back()->with('success', 'Article saved successfully.');
    }
}
