<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\HomepageNewsSlot;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category');

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        // Allowed columns (IMPORTANT)
        $allowedSorts = ['id', 'title', 'created_at'];

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->latest();
        }

        $articles = $query->paginate(10)->appends($request->query());

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.articles.create', compact('categories'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('admin.articles.edit', compact('article', 'categories'));
    }
    
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,pending,approved,rejected',
        ]);

        $article = new Article();

        $article->category_id = $request->category_id;
        $article->title = $request->title;

        $baseSlug = Str::slug($request->slug ?: $request->title);
        $slug = $baseSlug;
        $count = 1;

        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        $article->slug = $slug;

        $article->sub_title = $request->sub_title;
        $article->short_article = $request->short_article;

        // Banner (basic handling)
        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('articles', 'public');
            $article->banner = $path;
        }

        $article->meta_title = $request->meta_title;
        $article->meta_description = $request->meta_description;

        $article->created_by = Auth::id();
        $article->updated_by = Auth::id();
        
        $article->full_article = $request->full_article;

        $status = $request->status;

        if (
            !auth()->user()->hasPermission('approve_disapprove_news_article') &&
            in_array($status, ['approved', 'rejected'])
        ) {
            $status = 'pending';
        }

        $article->status = $status ?? 'draft';
        
        if ($status === 'approved') {
            $article->approved_by = Auth::id();
            $article->approved_at = now();
        } else {
            $article->approved_by = null;
            $article->approved_at = null;
        }

        $article->save();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article created successfully');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('articles', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,pending,approved,rejected',
        ]);

        $article->category_id = $request->category_id;
        $article->title = $request->title;

        // Slug uniqueness (exclude current)
        $baseSlug = Str::slug($request->slug ?: $request->title);
        $slug = $baseSlug;
        $count = 1;

        while (
            Article::where('slug', $slug)
                ->where('id', '!=', $article->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count++;
        }

        $article->slug = $slug;

        $article->sub_title = $request->sub_title;
        $article->short_article = $request->short_article;
        $article->full_article = $request->full_article;

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('articles', 'public');
            $article->banner = $path;
        }

        $article->meta_title = $request->meta_title;
        $article->meta_description = $request->meta_description;

        $article->updated_by = Auth::id();

        
        $status = $request->status;

        if (
            !auth()->user()->hasPermission('approve_disapprove_news_article') &&
            in_array($status, ['approved', 'rejected'])
        ) {
            $status = 'pending';
        }

        $article->status = $status ?? 'draft';

        if ($status === 'approved') {
            $article->approved_by = Auth::id();
            $article->approved_at = now();
        } else {
            $article->approved_by = null;
            $article->approved_at = null;
        }

        $article->save();

        if ($article->status !== 'approved') {
            HomepageNewsSlot::where('article_id', $article->id)->delete();
        }

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article updated successfully');
    }

    public function destroy($id)
    {
        //
    }
}
