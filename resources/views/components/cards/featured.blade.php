@props([
    'title',
    'excerpt' => null,
    'imageHeight' => 'h-56 lg:h-80'
])

<article {{ $attributes }}>

    <!-- <div class="w-full {{ $imageHeight }} bg-neutral-300 rounded-md mb-4 shadow-sm"></div> -->
    <img 
        src="https://placehold.co/400x300/374151/ffffff?text=Story"
        alt=""
        class="w-full {{ $imageHeight }} object-cover rounded-md flex-shrink-0 shadow-sm"
    />


    <h3 class="text-lg lg:text-2xl font-semibold leading-tight mb-2">
        {{ $title }}
    </h3>

    @if($excerpt)
        <p class="text-neutral-600 text-sm">
            {{ $excerpt }}
        </p>
    @endif
</article>
