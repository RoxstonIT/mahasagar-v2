@extends('subscriber.layout')

@section('title', 'My Comments')

@section('content')
<div class="bg-white border border-neutral-200 p-8">
    <h1 class="text-3xl font-bold tracking-tight mb-6">My Comments</h1>

    @forelse($comments as $comment)
        @if($comment->article)
            <article class="border-t border-neutral-200 py-5 first:border-t-0 first:pt-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                    <h2 class="text-lg font-bold leading-tight">
                        <a href="{{ route('news.show', $comment->article->slug) }}" class="hover:text-[#ec1e20]">
                            {{ $comment->article->title }}
                        </a>
                    </h2>

                    <span class="text-xs font-semibold uppercase tracking-widest text-neutral-500">
                        {{ ucfirst($comment->status) }}
                    </span>
                </div>

                <p class="text-neutral-700 leading-relaxed">
                    {{ $comment->body }}
                </p>

                <p class="text-sm text-neutral-500 mt-3">
                    Posted {{ $comment->created_at->format('d M Y') }}
                </p>
            </article>
        @endif
    @empty
        <p class="text-neutral-600">No comments yet.</p>
    @endforelse
</div>
@endsection
