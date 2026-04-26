<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="{{ $article->meta_description }}">

    <title>{{ $article->meta_title ?? $article->title }}</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto bg-white p-6 mt-10 rounded-lg shadow">

        {{-- Title --}}
        <h1 class="text-3xl font-bold mb-4">
            {{ $article->title }}
        </h1>

        {{-- Category --}}
        <p class="text-sm text-gray-500 mb-2">
            Category: {{ $article->category->name ?? 'Uncategorized' }}
        </p>

        {{-- Subtitle --}}
        @if($article->sub_title)
            <p class="text-lg text-gray-700 mb-4">
                {{ $article->sub_title }}
            </p>
        @endif

        {{-- Banner --}}
        @if($article->banner)
            <img src="{{ asset('storage/' . $article->banner) }}"
                class="w-full rounded mb-6">
        @endif

        {{-- Content --}}
        <div class="prose max-w-none">
            {!! $article->full_article !!}
        </div>

    </div>

</body>
</html>