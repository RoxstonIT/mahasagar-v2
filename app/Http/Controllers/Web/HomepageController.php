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
                ->take(10)
                ->orderBy('id'); // or position column later
        }])->get();

        return view('web.home', compact('categories'));
    }
}
