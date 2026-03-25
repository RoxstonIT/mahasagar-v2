@extends('layouts.web.app')

@section('title', 'Article')

@section('content')

<!-- Article Header -->
<section class="pt-16">
    <div class="max-w-4xl mx-auto px-4">

        <!-- Category -->
        <span class="text-xs font-semibold uppercase tracking-widest text-red-700">
            National
        </span>

        <!-- Headline -->
        <h1 class="text-4xl lg:text-5xl font-bold leading-tight tracking-tight mt-4 mb-6">
            Infrastructure Expansion Accelerates Across Key States
        </h1>

        <!-- Subheadline -->
        <p class="text-lg text-neutral-600 mb-8">
            Major development initiatives aim to modernize transport, public services, and regional connectivity nationwide.
        </p>

        <!-- Meta -->
        <div class="text-sm text-neutral-500">
            By <span class="font-semibold text-neutral-700">Editorial Desk</span> · {{ now()->format('d M Y') }}
        </div>

        <!-- Hero Image -->
        <div class="mt-12">
            <img 
                src="https://placehold.co/1200x700/1f2937/ffffff?text=Article+Hero+Image"
                alt=""
                class="w-full h-[420px] lg:h-[520px] object-cover"
            >
            <p class="text-xs text-neutral-500 mt-2">
                Infrastructure projects underway in multiple states aim to boost connectivity and economic growth.
            </p>
        </div>

    </div>
</section>

<div class="max-w-3xl mx-auto px-4">
    <div class="border-t border-neutral-200 my-12"></div>
</div>

<!-- Article Body -->
<section class="pb-24">
    <div class="max-w-3xl mx-auto px-4">

        <div class="prose prose-lg max-w-none">

            <p>
                Across several states, infrastructure expansion initiatives are reshaping urban and rural landscapes alike. Governments are accelerating investments in transport corridors, logistics networks, and public utilities to stimulate economic growth and regional connectivity.
            </p>

            <p>
                Policy experts argue that sustained infrastructure spending plays a crucial role in strengthening long-term economic resilience. Enhanced road networks, improved rail connectivity, and modernized public services contribute directly to productivity gains and investment confidence.
            </p>

            <h2>Strategic Planning and Regional Focus</h2>

            <p>
                Strategic regional planning ensures that development projects address local needs while aligning with national objectives. Several high-impact corridors are expected to reduce transit times and enhance trade competitiveness.
            </p>

            <blockquote>
                Infrastructure is not merely about construction. It is about creating long-term foundations for national prosperity.
            </blockquote>

            <p>
                Industry stakeholders emphasize the importance of transparent execution frameworks and sustainable funding models. Public-private partnerships continue to play a central role in expanding large-scale projects efficiently.
            </p>

            <h2>Looking Ahead</h2>

            <p>
                As implementation progresses, analysts will closely monitor economic indicators and regional performance metrics to evaluate the broader impact of these initiatives.
            </p>

        </div>

    </div>
</section>

<div class="max-w-3xl mx-auto px-4">
    <div class="border-t border-neutral-200 my-16"></div>
</div>

<!-- Related Articles -->
<section class="pb-24">
    <div class="max-w-5xl mx-auto px-4">

        <h2 class="text-2xl font-bold tracking-tight mb-10">
            Related Articles
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <x-web.cards.vertical
                title="Urban Infrastructure Projects Gain Momentum"
                excerpt="Large-scale initiatives aim to modernize key metropolitan regions."
            />

            <x-web.cards.vertical
                title="Public Transport Systems Undergo Major Upgrades"
                excerpt="Transit networks expand to improve connectivity and efficiency."
            />

            <x-web.cards.vertical
                title="Policy Reforms Target Sustainable Development"
                excerpt="New frameworks emphasize long-term environmental and economic balance."
            />

        </div>

    </div>
</section>


@endsection