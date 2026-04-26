@extends('layouts.web.app')

@section('title', $category->name)

@section('content')

<!-- Category Header -->
<section class="bg-neutral-100 py-16">
    <div class="max-w-7xl mx-auto px-4">

        <h1 class="text-4xl lg:text-5xl font-bold tracking-tight mb-4">
            {{ $category->name }}
        </h1>

        <p class="text-neutral-600 max-w-2xl">
            {{ $category->description ?? 'Explore the latest stories, analysis, and reporting from the ' . strtolower($category->name) . ' desk.' }}
        </p>

    </div>
</section>

@php
    $featured = $articles->first();
@endphp

@if($articles->count())

<!-- Featured Article -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">

        <article class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <img
                src="{{ $featured->banner ? asset('storage/'.$featured->banner) : 'https://placehold.co/800x500/1f2937/ffffff?text=Featured+Story' }}"
                alt="{{ $featured->title }}"
                class="w-full h-80 lg:h-[420px] object-cover rounded-xl"
            />

            <div>
                <span class="text-xs font-semibold uppercase tracking-widest text-red-700">
                    Featured
                </span>

                <h2 class="text-3xl lg:text-4xl font-bold leading-tight mt-3 mb-4 tracking-tight">
                    <a href="{{ route('news.show', $featured->slug) }}" class="hover:underline">
                        {{ $featured->title }}
                    </a>
                </h2>

                @if($featured->sub_title)
                    <p class="text-neutral-700 mb-4 text-lg">
                        {{ $featured->sub_title }}
                    </p>
                @endif

                <p class="text-neutral-600 mb-6">
                    {{ $featured->short_article }}
                </p>

                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-6 text-sm text-neutral-600">
                    <span>
                        {{ $featured->approved_at?->format('F j, Y') ?? $featured->created_at->format('F j, Y') }}
                    </span>
                    <a href="{{ route('news.show', $featured->slug) }}" class="text-red-700 font-semibold hover:underline mt-3 sm:mt-0">
                        Read Full Story →
                    </a>
                </div>
            </div>

        </article>

    </div>
</section>

<!-- Article Grid -->
<section class="pb-20">
    <div class="max-w-7xl mx-auto px-4">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles->slice(1) as $article)
                <article class="border border-neutral-200 rounded-3xl overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                    <a href="{{ route('news.show', $article->slug) }}" class="block group">
                        <img
                            src="{{ $article->banner ? asset('storage/'.$article->banner) : 'https://placehold.co/600x400/1f2937/ffffff?text=Story' }}"
                            alt="{{ $article->title }}"
                            class="w-full h-56 object-cover"
                        />

                        <div class="p-6">
                            <p class="text-xs uppercase tracking-widest text-red-700 mb-3">
                                {{ $article->approved_at?->format('F j, Y') ?? $article->created_at->format('F j, Y') }}
                            </p>

                            <h3 class="text-2xl font-semibold text-neutral-900 mb-3 group-hover:text-red-700 transition">
                                {{ $article->title }}
                            </h3>

                            @if($article->sub_title)
                                <p class="text-neutral-700 mb-3">
                                    {{ $article->sub_title }}
                                </p>
                            @endif

                            <p class="text-neutral-600 text-sm leading-relaxed mb-5">
                                {{ $article->short_article }}
                            </p>

                            <span class="text-red-700 font-semibold hover:underline">
                                Read More →
                            </span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

    </div>
</section>

<!-- Pagination -->
<section class="pb-24">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-center">
            {{ $articles->withQueryString()->links() }}
        </div>
    </div>
</section>

@else

<section class="py-20">
    <div class="max-w-4xl mx-auto px-4">
        <div class="rounded-[2rem] border border-neutral-200 bg-white p-12 text-center shadow-sm">
            <span class="text-xs uppercase tracking-widest text-red-700 font-semibold">
                No stories yet
            </span>
            <h2 class="mt-6 text-3xl font-bold text-neutral-900">
                There are no approved articles in this category yet.
            </h2>
            <p class="mt-4 text-neutral-600">
                We’re preparing fresh coverage for {{ strtolower($category->name) }}. Please check back soon for the latest editorial updates.
            </p>
        </div>
    </div>
</section>

@endif

@endsection

