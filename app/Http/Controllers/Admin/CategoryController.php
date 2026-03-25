<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = ['name', 'created_at'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        $categories = $query
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories', 'sort', 'direction'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $count = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $count = 1;

        while (Category::where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->exists()) {

            $slug = $baseSlug . '-' . $count++;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}