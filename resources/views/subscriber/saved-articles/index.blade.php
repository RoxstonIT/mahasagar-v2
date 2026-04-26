@extends('subscriber.layout')

@section('title', 'Saved Articles')

@section('content')
<div class="bg-white border border-neutral-200 p-8">
    <h1 class="text-3xl font-bold tracking-tight mb-6">Saved Articles</h1>

    @forelse($savedArticles as $savedArticle)
        @if($savedArticle->article)
            <article class="border-t border-neutral-200 py-5 first:border-t-0 first:pt-0">
                <p class="text-xs font-semibold uppercase tracking-widest text-[#ec1e20] mb-2">
                    {{ $savedArticle->article->category->name ?? 'News' }}
                </p>

                <h2 class="text-xl font-bold leading-tight mb-2">
                    <a href="{{ route('news.show', $savedArticle->article->slug) }}" class="hover:text-[#ec1e20]">
                        {{ $savedArticle->article->title }}
                    </a>
                </h2>

                <p class="text-sm text-neutral-500">
                    Saved {{ $savedArticle->created_at->format('d M Y') }}
                </p>
            </article>
        @endif
    @empty
        <p class="text-neutral-600">No saved articles yet.</p>
    @endforelse
</div>
@endsection
