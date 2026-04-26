@extends('layouts.web.app')

@section('title', 'Subscriber Dashboard')

@section('content')
<section class="py-16">
    <div class="max-w-5xl mx-auto px-4">
        <div class="border-t-4 border-[#ec1e20] bg-white p-8 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-widest text-[#ec1e20] mb-3">
                Subscriber
            </p>

            <h1 class="text-3xl font-bold tracking-tight mb-4">
                Welcome, {{ auth()->user()->name }}
            </h1>

            <p class="text-neutral-700 leading-relaxed">
                Your Mahasagar subscriber dashboard is ready. Protected subscriber features will appear here as they are added.
            </p>
        </div>
    </div>
</section>
@endsection
