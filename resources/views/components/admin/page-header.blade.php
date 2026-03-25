@props([
    'title',
    'breadcrumbs' => [],
    'action' => null
])

<div class="mb-6">

    {{-- Breadcrumbs --}}
    @if(count($breadcrumbs))
        <p class="text-sm text-gray-500 mb-1">
            @foreach($breadcrumbs as $crumb)
                @if(!$loop->last)
                    <a href="{{ $crumb['url'] }}" class="text-blue-600 hover:underline">
                        {{ $crumb['label'] }}
                    </a>
                    /
                @else
                    {{ $crumb['label'] }}
                @endif
            @endforeach
        </p>
    @endif

    {{-- Title + Action --}}
    <div class="flex items-center justify-between">

        <h1 class="text-2xl font-semibold">
            {{ $title }}
        </h1>

        @if($action)
            {{ $action }}
        @endif

    </div>

</div>