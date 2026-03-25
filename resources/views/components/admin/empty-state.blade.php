@props([
    'title' => 'No data found',
    'description' => null,
    'action' => null
])

<div class="flex flex-col items-center justify-center gap-3 py-10">

    <div class="text-gray-400 text-5xl">📂</div>

    <p class="text-gray-600 font-medium">
        {{ $title }}
    </p>

    @if($description)
        <p class="text-sm text-gray-400">
            {{ $description }}
        </p>
    @endif

    @if($action)
        <div class="mt-2">
            {{ $action }}
        </div>
    @endif

</div>