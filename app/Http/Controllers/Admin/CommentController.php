<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = ArticleComment::with([
            'user',
            'article' => fn ($q) => $q->withTrashed(),
        ]);

        $status = $request->input('status');
        $allowedStatuses = ['pending', 'approved', 'rejected'];

        if ($status && in_array($status, $allowedStatuses)) {
            $query->where('status', $status);
        }

        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('body', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('article', function ($articleQuery) use ($search) {
                        $articleQuery->where('title', 'like', '%' . $search . '%');
                    });
            });
        }

        $comments = $query->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('admin.comments.index', compact('comments'));
    }

    public function approve(ArticleComment $comment)
    {
        $comment->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Comment approved successfully');
    }

    public function reject(ArticleComment $comment)
    {
        $comment->update([
            'status' => 'rejected',
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return back()->with('success', 'Comment rejected successfully');
    }

    public function destroy(ArticleComment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
