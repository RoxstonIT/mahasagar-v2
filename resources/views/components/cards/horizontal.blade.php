@props([
    'title',
    'excerpt' => null
])

<article {{ $attributes }} class="flex gap-4">
    
    <img 
        src="https://placehold.co/400x300/374151/ffffff?text=Story"
        alt=""
        class="w-24 h-20 object-cover rounded-md flex-shrink-0 shadow-sm"
    />


    <div>
        <h4 class="font-semibold leading-snug">
            {{ $title }}
        </h4>

        @if($excerpt)
            <p class="text-xs text-neutral-500 mt-1">
                {{ $excerpt }}
            </p>
        @endif
    </div>
</article>
