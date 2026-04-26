@props([
    'title',
    'excerpt' => null,
    'banner' => null,
    'url' => null,
    'showReadMore' => false
])

<article {{ $attributes }} class="flex flex-col">

    <div class="flex gap-4">
        <img
            src="{{ $banner ? asset('storage/'.$banner) : 'https://placehold.co/400x300/374151/ffffff?text=Story' }}"
            alt="{{ $title }}"
            class="w-26 h-25 object-cover rounded-md flex-shrink-0 shadow-sm"
        />

        <div class="flex-1">
            <h4 class="font-semibold leading-snug">
                {{ $title }}
            </h4>

            @if($excerpt)
                <p class="text-xs text-neutral-500 mt-1 line-clamp-3">
                    {{ $excerpt }}
                </p>
                @if($showReadMore && $url)
                    <a href="{{ $url }}" class="text-red-700 text-xs font-semibold hover:underline">
                        Read More →
                    </a>
                @endif
            @endif
        </div>
    </div>


</article>
