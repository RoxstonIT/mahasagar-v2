@props([
    'title'
])

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold border-l-4 border-red-700 pl-3 tracking-tight">
        {{ $title }}
    </h2>

    <a href="#" class="text-sm text-neutral-600 hover:underline">
        View All
    </a>
</div>
