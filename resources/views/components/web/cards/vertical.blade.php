@props([
    'title' => null,
    'excerpt' => null,
    'link' => null,
    'banner' => null
])

<div class="flex flex-col h-full border border-neutral-200">

    <img
        src="{{ $banner ? asset('storage/'.$banner) : 'https://placehold.co/400x300/374151/ffffff?text=Card+Image' }}"
        alt="{{ $title }}"
        class="w-full h-48 object-cover"
    />

    <div class="p-4 flex flex-col">
        <div class="mb-4">
            <h3 class="text-xl font-bold mb-2 text-neutral-900">
                {{ $title ?? 'Card Title' }}
            </h3>
            <p class="text-neutral-600 text-sm line-clamp-3">
                {{ $excerpt ?? 'Card excerpt goes here.' }}
            </p>
        </div>
        <div class="mt-auto">
            <a href="@if(isset($link)){{ $link }} @else {{'javascript:void(0)'}} @endif" class="text-red-700 font-semibold hover:underline text-sm">
                Read More
            </a>
        </div>
    </div>

</div>
