@extends('layouts.web.app')

@section('title', 'Home')

@section('content')

<!-- Hero Section -->
<section class="bg-neutral-100 mt-12">
    <div class="max-w-7xl mx-auto px-4">

        @php
            $allArticles = $categories->pluck('articles')->flatten();
            $hero = $allArticles->first();
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <article class="lg:col-span-2">
                
                <img 
                    src="{{ $hero?->banner ? asset('storage/'.$hero->banner) : 'https://placehold.co/400x300' }}"
                    class="w-full h-80 lg:h-[390px] object-cover"
                />
        
                <span class="mt-6 block text-xs font-semibold uppercase tracking-widest text-red-700">
                    {{ $hero?->category->name ?? 'General' }}
                </span>

                <h2 class="text-3xl lg:text-5xl font-bold leading-tight mb-4 tracking-tight">
                    <a href="{{ route('news.show', $hero->slug) }}">
                        {{ $hero?->title }}
                    </a>
                </h2>

                <p class="text-neutral-600 text-sm lg:text-base">
                    {{ $hero?->short_article }}
                </p>
            </article>

            <div class="space-y-6 lg:h-[550px] overflow-y-auto">
                @foreach($sidebarArticles->reject(fn($article) => $article->id === $hero?->id)->take(6) as $article)
                    <x-web.cards.horizontal
                        :title="$article->title"
                        :excerpt="$article->short_article"
                        :banner="$article->banner"
                        :url="route('news.show', $article->slug)"
                        :showReadMore="true"
                    />
                @endforeach
            </div>

        </div>
        
    </div>
</section>

<!-- Breaking News Strip -->
<section class="bg-red-700 text-white mt-12 py-8">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex flex-col md:flex-row md:items-center gap-3">
            <span class="font-bold uppercase text-sm tracking-wide">Breaking</span>
            <div class="flex-1 space-y-2 md:space-y-0 md:flex md:gap-6 text-sm">
                <a href="#" class="hover:underline">Parliament debates key economic reforms amid rising inflation.</a>
                <a href="#" class="hover:underline">Global markets fluctuate following international policy shifts.</a>
                <a href="#" class="hover:underline">Major technology summit announces cross-border collaborations.</a>
            </div>
        </div>
    </div>
</section>

{{-- 🔥 DYNAMIC CATEGORY LOOP --}}
@foreach($categories as $index => $category)

    @php
        $articles = $category->approvedArticles;
    @endphp

    {{-- TYPE 1 → HERO + SIDE --}}
    @if($index % 3 === 0)

    <section class="px-4 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4">
        
            <x-web.section-header :title="$category->name" :categorySlug="$category->slug" />

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <x-web.cards.featured
                    class="lg:col-span-2"
                    :title="$articles->first()?->title"
                    :excerpt="$articles->first()?->short_article"
                    :banner="$articles->first()?->banner"
                    :url="route('news.show', $articles->first()->slug)"
                />

                <div class="space-y-6 mt">
                    @foreach($articles->skip(1)->take(4) as $article)
                        <x-web.cards.horizontal
                            :title="$article->title"
                            :excerpt="$article->short_article"
                            :banner="$article->banner"
                            :url="route('news.show', $article->slug)"
                            :showReadMore="true"
                        />
                    @endforeach
                </div>

            </div>
            
        </div>
    </section>

    {{-- TYPE 2 → BLACK OPINION STYLE --}}
    @elseif($index % 3 === 1)

    <section class="bg-neutral-900 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4">

            <div class="flex items-center justify-between mb-10">
                <h2 class="text-3xl font-bold tracking-tight">
                    {{ $category->name }}
                </h2>
                <a href="{{ route('category.show', $category->slug) }}" class="text-sm text-neutral-300 hover:underline">
                    View All
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                @foreach($articles->take(3) as $article)
                    <article>
                        <h3 class="text-2xl font-bold mb-4 leading-tight">
                            <a href="{{ route('news.show', $article->slug) }}" class="hover:underline">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-neutral-300 text-sm mb-4">
                            {{ $article->short_article }}
                        </p>
                        <a href="{{ route('news.show', $article->slug) }}" class="text-red-700 text-sm font-semibold hover:underline">
                            Read More →
                        </a>
                    </article>
                @endforeach

            </div>

        </div>
    </section>

    {{-- TYPE 3 → GRID --}}
    @else

    <section class="px-4 mt-12 pb-16 border-b border-neutral-200">
        <div class="max-w-7xl mx-auto px-4">

            <x-web.section-header :title="$category->name" :categorySlug="$category->slug" />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($articles->take(6) as $article)
                    <x-web.cards.vertical
                        :title="$article->title"
                        :excerpt="$article->short_article"
                        :banner="$article->banner"
                        :link="route('news.show', $article->slug)"
                    />
                @endforeach

            </div>

        </div>
    </section>

    @endif

@endforeach

@endsection