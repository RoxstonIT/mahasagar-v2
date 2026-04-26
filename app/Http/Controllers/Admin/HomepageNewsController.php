<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\HomepageNewsSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class HomepageNewsController extends Controller
{
    public function index()
    {
        $approvedArticles = Article::with('category')
            ->where('status', 'approved')
            ->latest()
            ->get();

        $slots = HomepageNewsSlot::with('article.category')
            ->get()
            ->keyBy('slot');

        return view('admin.homepage-news.index', compact('approvedArticles', 'slots'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'featured_article_id' => ['nullable', 'integer'],
            'breaking_article_ids' => ['nullable', 'array', 'max:3'],
            'breaking_article_ids.*' => ['nullable', 'integer'],
        ]);

        $featuredArticleId = $request->filled('featured_article_id')
            ? (int) $request->input('featured_article_id')
            : null;

        $breakingArticleIds = collect($request->input('breaking_article_ids', []))
            ->map(fn ($id) => $id ? (int) $id : null)
            ->values();

        $selectedArticleIds = $breakingArticleIds
            ->filter()
            ->when($featuredArticleId, fn ($ids) => $ids->prepend($featuredArticleId))
            ->values();

        if ($selectedArticleIds->count() !== $selectedArticleIds->unique()->count()) {
            throw ValidationException::withMessages([
                'featured_article_id' => 'The same article cannot be selected more than once.',
            ]);
        }

        if ($featuredArticleId && $breakingArticleIds->contains($featuredArticleId)) {
            throw ValidationException::withMessages([
                'featured_article_id' => 'Featured News cannot also be selected as Breaking News.',
            ]);
        }

        if ($selectedArticleIds->isNotEmpty()) {
            $approvedCount = Article::whereIn('id', $selectedArticleIds)
                ->where('status', 'approved')
                ->count();

            if ($approvedCount !== $selectedArticleIds->count()) {
                throw ValidationException::withMessages([
                    'featured_article_id' => 'Only approved articles can be selected for homepage news.',
                ]);
            }
        }

        DB::transaction(function () use ($featuredArticleId, $breakingArticleIds) {
            HomepageNewsSlot::whereIn('slot', HomepageNewsSlot::SLOTS)->delete();

            if ($featuredArticleId) {
                HomepageNewsSlot::create([
                    'slot' => HomepageNewsSlot::FEATURED,
                    'article_id' => $featuredArticleId,
                    'selected_by' => Auth::id(),
                ]);
            }

            foreach (HomepageNewsSlot::BREAKING_SLOTS as $index => $slot) {
                $articleId = $breakingArticleIds->get($index);

                if (!$articleId) {
                    continue;
                }

                HomepageNewsSlot::create([
                    'slot' => $slot,
                    'article_id' => $articleId,
                    'selected_by' => Auth::id(),
                ]);
            }
        });

        return redirect()
            ->route('admin.homepage-news.index')
            ->with('success', 'Homepage news updated successfully');
    }
}
