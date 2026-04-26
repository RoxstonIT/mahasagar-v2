<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CommentController extends Controller
{
    public function index()
    {
        $comments = collect();

        if (Schema::hasTable('article_comments')) {
            $comments = ArticleComment::with('article.category')
                ->where('user_id', auth()->id())
                ->whereHas('article')
                ->latest()
                ->get();
        }

        return view('subscriber.comments.index', compact('comments'));
    }

    public function store(Request $request, Article $article)
    {
        if ($article->status !== 'approved') {
            abort(404);
        }

        $data = $request->validate([
            'body' => ['required', 'string', 'min:3', 'max:2000'],
        ]);

        ArticleComment::create([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'body' => $data['body'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your comment has been submitted for moderation.');
    }
}
