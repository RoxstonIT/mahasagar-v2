@extends('layouts.web.app')

@section('title', $article->meta_title ?? $article->title)

@section('content')

<!-- Article Header -->
<section class="pt-16">
    <div class="max-w-4xl mx-auto px-4">

        <!-- Category -->
        <span class="text-xs font-semibold uppercase tracking-widest text-red-700">
            {{ $article->category->name }}
        </span>

        <!-- Headline -->
        <h1 class="text-4xl lg:text-5xl font-bold leading-tight tracking-tight mt-4 mb-6">
            {{ $article->title }}
        </h1>

        <!-- Subheadline -->
        @if($article->sub_title)
            <p class="text-lg text-neutral-600 mb-8">
                {{ $article->sub_title }}
            </p>
        @endif

        <!-- Meta -->
        <div class="text-sm text-neutral-500">
            By <span class="font-semibold text-neutral-700">{{ $article->meta['author'] ?? $article->creator->name ?? 'Editorial Desk' }}</span> · {{ $article->approved_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}
        </div>

        <!-- Hero Image -->
        <div class="mt-12">
            <img
                src="{{ $article->banner ? asset('storage/'.$article->banner) : 'https://placehold.co/1200x700/1f2937/ffffff?text=Article+Hero+Image' }}"
                alt="{{ $article->title }}"
                class="w-full h-[420px] lg:h-[520px] object-cover"
            >
            @if($article->meta_description)
                <p class="text-xs text-neutral-500 mt-2">
                    {{ $article->meta_description }}
                </p>
            @endif
        </div>

    </div>
</section>

<div class="max-w-3xl mx-auto px-4">
    <div class="border-t border-neutral-200 my-12"></div>
</div>

<!-- Article Body -->
<section class="pb-24">
    <div class="max-w-3xl mx-auto px-4">

        <div class="prose prose-lg max-w-none">
            {!! $article->full_article !!}
        </div>

    </div>
</section>

<div class="max-w-3xl mx-auto px-4">
    <div class="border-t border-neutral-200 my-16"></div>
</div>

<!-- Related Articles -->
<section class="pb-24">
    <div class="max-w-5xl mx-auto px-4">

        <h2 class="text-2xl font-bold tracking-tight mb-10">
            Related Articles
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($relatedArticles as $related)
                <article class="border border-neutral-200 rounded-3xl overflow-hidden bg-white shadow-sm hover:shadow-md transition">
                    <a href="{{ route('news.show', $related->slug) }}" class="block group">
                        <img
                            src="{{ $related->banner ? asset('storage/'.$related->banner) : 'https://placehold.co/600x400/1f2937/ffffff?text=Story' }}"
                            alt="{{ $related->title }}"
                            class="w-full h-56 object-cover"
                        />

                        <div class="p-6">
                            <p class="text-xs uppercase tracking-widest text-red-700 mb-3">
                                {{ $related->approved_at?->format('F j, Y') ?? $related->created_at->format('F j, Y') }}
                            </p>

                            <h3 class="text-2xl font-semibold text-neutral-900 mb-3 group-hover:text-red-700 transition">
                                {{ $related->title }}
                            </h3>

                            @if($related->sub_title)
                                <p class="text-neutral-700 mb-3">
                                    {{ $related->sub_title }}
                                </p>
                            @endif

                            <p class="text-neutral-600 text-sm leading-relaxed mb-5">
                                {{ $related->short_article }}
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


@endsection