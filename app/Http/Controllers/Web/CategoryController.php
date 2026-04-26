<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = $category->articles()
            ->where('status', 'approved')
            ->latest()
            ->paginate(12);

        return view('web.category', compact('category', 'articles'));
    }
}