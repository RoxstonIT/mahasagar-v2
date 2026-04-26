<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use App\Models\ArticleLike;
use App\Models\SavedArticle;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'saved_articles' => $this->countArticleRecords(SavedArticle::class, 'saved_articles', $user->id),
            'liked_articles' => $this->countArticleRecords(ArticleLike::class, 'article_likes', $user->id),
            'comments' => $this->countForUser(ArticleComment::class, 'article_comments', $user->id),
        ];

        return view('subscriber.dashboard', compact('stats'));
    }

    private function countArticleRecords($model, $table, $userId)
    {
        if (!Schema::hasTable($table)) {
            return 0;
        }

        return $model::where('user_id', $userId)
            ->whereHas('article', fn ($q) => $q->where('status', 'approved'))
            ->count();
    }

    private function countForUser($model, $table, $userId)
    {
        if (!Schema::hasTable($table)) {
            return 0;
        }

        return $model::where('user_id', $userId)->count();
    }
}
