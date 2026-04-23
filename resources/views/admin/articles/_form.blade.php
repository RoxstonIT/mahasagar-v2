<form method="POST"
      action="{{ isset($article) 
            ? route('admin.articles.update', $article->id) 
            : route('admin.articles.store') }}"
      enctype="multipart/form-data">

    @csrf

    @if(isset($article))
        @method('PUT')
    @endif

    <div class="space-y-6">

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div>
            <label class="block mb-1 font-medium">Category</label>

            <select name="category_id" class="w-full border rounded px-3 py-2">

                <option value="">Select Category</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Title</label>

            <input type="text"
                value="{{ old('title', $article->title ?? '') }}"
                id="title"
                name="title"
                class="w-full border rounded px-3 py-2"
                placeholder="Enter article title">
        </div>

        <div>
            <label class="block mb-1 font-medium">Slug</label>

            <input type="text"
                value="{{ old('slug', $article->slug ?? '') }}"
                id="slug"
                name="slug"
                class="w-full border rounded px-3 py-2"
                placeholder="article-slug">
        </div>

        <div>
            <label class="block mb-1 font-medium">Sub Title</label>

            <input type="text"
                value="{{ old('sub_title', $article->sub_title ?? '') }}"
                name="sub_title"
                class="w-full border rounded px-3 py-2"
                placeholder="Optional sub headline">
        </div>

        <div>
            <label class="block mb-1 font-medium">Banner</label>

            <input type="file"
                value="{{ old('banner') }}"
                name="banner"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1 font-medium">Status</label>

            <select name="status" class="w-full border rounded px-3 py-2">

                <option value="draft"
                    {{ old('status', $article->status ?? '') == 'draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="pending"
                    {{ old('status', $article->status ?? '') == 'pending' ? 'selected' : '' }}>
                    Pending Review
                </option>

                @if(auth()->user()->hasPermission('approve_disapprove_news_article'))

                    <option value="approved"
                        {{ old('status', $article->status ?? '') == 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>

                    <option value="rejected"
                        {{ old('status', $article->status ?? '') == 'rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>

                @endif

            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Meta Title</label>

            <input type="text"
                name="meta_title"
                value="{{ old('meta_title', $article->meta_title ?? '') }}"
                class="w-full border rounded px-3 py-2"
                placeholder="SEO title">
        </div>

        <div>
            <label class="block mb-1 font-medium">Meta Description</label>

            <textarea name="meta_description"
                rows="3"
                class="w-full border rounded px-3 py-2"
                placeholder="SEO description">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Short Article</label>

            <textarea name="short_article"
                rows="3"
                class="w-full border rounded px-3 py-2"
                placeholder="Short summary">{{ old('short_article', $article->short_article ?? '') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Full Article</label>

            <div class="flex gap-2 mb-2">

                <button type="button" data-action="bold"
                    class="px-3 py-1 border rounded toolbar-btn">B</button>

                <button type="button" data-action="italic"
                    class="px-3 py-1 border rounded toolbar-btn">I</button>

                <button type="button" data-action="h1"
                    class="px-3 py-1 border rounded toolbar-btn">H1</button>

                <button type="button" data-action="h2"
                    class="px-3 py-1 border rounded toolbar-btn">H2</button>

                <button type="button" data-action="ul"
                    class="px-3 py-1 border rounded toolbar-btn">UL</button>

                <button type="button" data-action="ol"
                    class="px-3 py-1 border rounded toolbar-btn">OL</button>

                <button type="button" data-action="image"
                    class="px-3 py-1 border rounded toolbar-btn">IMG</button>

                <button type="button" data-action="youtube"
                    class="px-3 py-1 border rounded toolbar-btn">YouTube</button>

                <button type="button" data-action="embed"
                    class="px-3 py-1 border rounded toolbar-btn">EMB</button>

            </div>

            <div id="editor" class="prose max-w-none w-full border rounded px-3 py-2 min-h-[300px] bg-white"></div>

            <textarea name="full_article"
                    id="full_article"
                    class="hidden">{{ old('full_article', $article->full_article ?? '') }}</textarea>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-[#ec1e20] text-white px-6 py-2 rounded">
                Save Article
            </button>
        </div>
        
    </div>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('input', function () {

            let slug = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            slugInput.value = slug;
        });

    });
</script>