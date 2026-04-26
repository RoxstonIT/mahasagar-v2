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

<!-- Subscriber Interaction Preparation -->
<section class="pb-16">
    <div class="max-w-3xl mx-auto px-4">
        <div class="border border-neutral-200 bg-white p-6">
            <h2 class="text-2xl font-bold tracking-tight mb-4">
                Reader Actions
            </h2>

            @if(session('success'))
                <div class="mb-5 bg-green-50 text-green-700 p-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 bg-red-50 text-red-700 p-4 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @auth
                @if(auth()->user()->hasRole('reader') && auth()->user()->hasVerifiedEmail())
                    <div class="flex flex-col sm:flex-row gap-3 mb-6" data-article-actions="{{ $article->id }}">
                        <form method="POST" action="{{ route('subscriber.articles.save', $article) }}">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 border text-sm font-semibold {{ $isSaved ? 'border-[#ec1e20] bg-[#ec1e20] text-white' : 'border-neutral-300 text-neutral-800 hover:border-[#ec1e20] hover:text-[#ec1e20]' }}">
                                {{ $isSaved ? 'Unsave Article' : 'Save Article' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('subscriber.articles.like', $article) }}">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 border text-sm font-semibold {{ $isLiked ? 'border-[#ec1e20] bg-[#ec1e20] text-white' : 'border-neutral-300 text-neutral-800 hover:border-[#ec1e20] hover:text-[#ec1e20]' }}">
                                {{ $isLiked ? 'Unlike Article' : 'Like Article' }}
                            </button>
                        </form>
                    </div>

                    <div id="comments" data-article-comments="{{ $article->id }}">
                        <form method="POST" action="{{ route('subscriber.articles.comments.store', $article) }}">
                            @csrf

                            <label class="block text-sm font-semibold mb-2">Comment</label>
                            <textarea name="body"
                                      rows="4"
                                      class="w-full border border-neutral-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                      placeholder="Share your comment for moderation.">{{ old('body') }}</textarea>

                            <button type="submit" class="mt-3 bg-[#ec1e20] text-white px-4 py-2 text-sm font-semibold hover:opacity-90">
                                Post Comment
                            </button>
                        </form>
                    </div>
                @elseif(auth()->user()->hasRole('reader'))
                    <p class="text-sm text-neutral-600">
                        Please verify your email to save, like, or comment on articles.
                    </p>
                    <a href="{{ route('verification.notice') }}" class="inline-block mt-4 text-sm font-semibold text-[#ec1e20] hover:underline">
                        Verify Email
                    </a>
                @else
                    <p class="text-sm text-neutral-600">
                        Subscriber article actions are available for reader accounts.
                    </p>
                @endif
            @else
                <p class="text-sm text-neutral-600">
                    Login or register as a reader to save, like, or comment on articles.
                </p>
                <div class="flex gap-4 mt-4 text-sm font-semibold">
                    <a href="{{ route('subscriber.login') }}" class="text-[#ec1e20] hover:underline">Login</a>
                    <a href="{{ route('subscriber.register') }}" class="text-[#ec1e20] hover:underline">Register</a>
                </div>
            @endauth
        </div>
    </div>
</section>

<!-- Approved Comments -->
<section class="pb-16">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-2xl font-bold tracking-tight mb-6">
            Reader Comments
        </h2>

        <div class="space-y-5">
            @forelse($approvedComments as $comment)
                <article class="border border-neutral-200 bg-white p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                        <p class="font-semibold text-neutral-900">
                            {{ $comment->user->name ?? 'Reader' }}
                        </p>

                        <p class="text-xs text-neutral-500">
                            {{ $comment->approved_at?->format('d M Y') ?? $comment->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <p class="text-neutral-700 leading-relaxed">
                        {{ $comment->body }}
                    </p>
                </article>
            @empty
                <p class="text-sm text-neutral-600">
                    No approved comments yet.
                </p>
            @endforelse
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
