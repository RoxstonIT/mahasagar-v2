@props([
    'title',
    'excerpt' => null,
    'imageHeight' => 'h-56 lg:h-80',
    'banner' => null,
    'url' => null
])


<article {{ $attributes }}>
    @if($url)
        <a href="{{ $url }}" class="block group">
    @endif

    <img
        src="{{ $banner ? asset('storage/'.$banner) : 'https://placehold.co/400x300/374151/ffffff?text=Story' }}"
        alt="{{ $title }}"
        class="w-full {{ $imageHeight }} object-cover rounded-md flex-shrink-0 shadow-sm"
    />

    <h3 class="text-lg lg:text-2xl font-semibold leading-tight my-6 {{ $url ? 'group-hover:text-red-700 transition' : '' }}">
        {{ $title }}
    </h3>

    @if($excerpt)
        <p class="text-neutral-600 text-sm">
            {{ $excerpt }}
        </p>
    @endif
    
    @if($url)
        </a>
    @endif

</article>

