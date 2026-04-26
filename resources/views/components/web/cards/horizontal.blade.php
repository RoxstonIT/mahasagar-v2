@props([
    'title',
    'excerpt' => null,
    'banner' => null,
    'url' => null
])

@if($url)
    <a href="{{ $url }}" class="block group">
@endif

<article {{ $attributes }} class="flex gap-4">

    <img
        src="{{ $banner ? asset('storage/'.$banner) : 'https://placehold.co/400x300/374151/ffffff?text=Story' }}"
        alt="{{ $title }}"
        class="w-24 h-20 object-cover rounded-md flex-shrink-0 shadow-sm"
    />

    <div>
        <h4 class="font-semibold leading-snug {{ $url ? 'group-hover:text-red-700 transition' : '' }}">
            {{ $title }}
        </h4>

        @if($excerpt)
            <p class="text-xs text-neutral-500 mt-1 line-clamp-3">
                {{ $excerpt }}
            </p>
        @endif
    </div>

</article>

@if($url)
    </a>
@endif
