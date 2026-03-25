@props([
    'headers' => [],
    'sort' => null,
    'direction' => null,
])


<table class="w-full text-left">

    {{-- Header --}}
    <thead class="bg-gray-100">
        <tr>
            @foreach($headers as $key => $header)

                <th class="p-4">

                    @if(is_array($header) && isset($header['sortable']) && $header['sortable'])

                        @php
                            $isActive = $sort === $header['key'];
                            $newDirection = ($isActive && $direction === 'asc') ? 'desc' : 'asc';
                        @endphp

                        <a href="{{ request()->fullUrlWithQuery([
                            'sort' => $header['key'],
                            'direction' => $newDirection
                        ]) }}"
                            class="flex items-center gap-1 hover:underline">

                            {{ $header['label'] }}

                            {{-- Sort Indicator --}}
                            @if($isActive)
                                <span>
                                    {{ $direction === 'asc' ? '↑' : '↓' }}
                                </span>
                            @endif

                        </a>

                    @else
                        {{ is_array($header) ? $header['label'] : $header }}
                    @endif

                </th>

            @endforeach
        </tr>
    </thead>

    {{-- Body --}}
    <tbody>
        {{ $slot }}
    </tbody>

</table>
