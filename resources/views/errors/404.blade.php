@extends('layouts.web.app')

@section('title', 'Page Not Found')

@section('content')

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 text-center">

        <p class="text-sm uppercase tracking-widest text-red-700 font-semibold mb-6">
            404 Error
        </p>

        <h1 class="text-4xl lg:text-5xl font-bold tracking-tight mb-6">
            The page you are looking for does not exist.
        </h1>

        <p class="text-neutral-600 mb-10">
            It may have been moved, removed, or the link you followed may be incorrect.
        </p>

        <div class="flex justify-center gap-6 text-sm font-semibold">
            <a href="/" class="text-red-700 hover:underline">
                Return to Homepage
            </a>
            <a href="#" class="text-neutral-700 hover:underline">
                Browse Sections
            </a>
        </div>

    </div>
</section>

@endsection