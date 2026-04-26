<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use \App\Models\Category;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $categories = Category::with(['approvedArticles' => function ($q) {
            $q->latest()
                // ->take(10)
                ->orderBy('id'); // or position column later
        }])->get();

        // Generate balanced sidebar articles (max 2 per category)
        $sidebarArticles = collect();
        
        foreach ($categories as $category) {
            $categoryArticles = $category->approvedArticles->take(2);
            $sidebarArticles = $sidebarArticles->concat($categoryArticles);
        }
        
        // Shuffle for mixed editorial feel
        $sidebarArticles = $sidebarArticles->shuffle()->take(12);

        return view('web.home', compact('categories', 'sidebarArticles'));
    }
}
