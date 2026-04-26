@extends('layouts.admin.app')

@section('content')
    <div class="p-6">

        <x-admin.page-header 
            title="Homepage News"
            :breadcrumbs="[
                ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['label' => 'Homepage News']
            ]"
        />

        @php
            $currentFeatured = $slots->get('featured')?->article;
            $currentBreaking = collect(\App\Models\HomepageNewsSlot::BREAKING_SLOTS)
                ->map(fn ($slot) => $slots->get($slot)?->article)
                ->filter();

            $selectedFeatured = old('featured_article_id', $slots->get('featured')?->article_id);
            $selectedBreaking = collect(old('breaking_article_ids', collect(\App\Models\HomepageNewsSlot::BREAKING_SLOTS)
                ->map(fn ($slot) => $slots->get($slot)?->article_id)
                ->values()
                ->all()));
        @endphp

        @if ($errors->any())
            <div class="mb-6 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Current Featured News</h3>

                @if($currentFeatured)
                    <p class="font-medium">{{ $currentFeatured->title }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $currentFeatured->category->name ?? 'Uncategorized' }} - {{ ucfirst($currentFeatured->status) }}
                    </p>
                @else
                    <p class="text-sm text-gray-500">No featured article selected.</p>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Current Breaking News</h3>

                @forelse($currentBreaking as $article)
                    <div class="mb-3 last:mb-0">
                        <p class="font-medium">{{ $article->title }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $article->category->name ?? 'Uncategorized' }} - {{ ucfirst($article->status) }}
                        </p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No breaking articles selected.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <form method="POST" action="{{ route('admin.homepage-news.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 font-medium">Featured News</label>
                    <select name="featured_article_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]">
                        <option value="">No Featured News</option>

                        @foreach($approvedArticles as $article)
                            <option value="{{ $article->id }}" {{ (string) $selectedFeatured === (string) $article->id ? 'selected' : '' }}>
                                {{ $article->title }} - {{ $article->category->name ?? 'Uncategorized' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Breaking News</label>

                    <div class="space-y-3">
                        @foreach(\App\Models\HomepageNewsSlot::BREAKING_SLOTS as $index => $slot)
                            <select name="breaking_article_ids[]" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]">
                                <option value="">No Breaking News</option>

                                @foreach($approvedArticles as $article)
                                    <option value="{{ $article->id }}" {{ (string) $selectedBreaking->get($index) === (string) $article->id ? 'selected' : '' }}>
                                        {{ $article->title }} - {{ $article->category->name ?? 'Uncategorized' }}
                                    </option>
                                @endforeach
                            </select>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-[#ec1e20] text-white px-5 py-2 rounded-lg hover:opacity-90">
                        Save Homepage News
                    </button>

                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 rounded-lg border">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
