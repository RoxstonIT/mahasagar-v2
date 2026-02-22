@extends('layouts.app')

@section('title', 'Category')

@section('content')

<!-- Category Header -->
<section class="bg-neutral-100 py-16">
    <div class="max-w-7xl mx-auto px-4">

        <h1 class="text-4xl lg:text-5xl font-bold tracking-tight mb-4">
            National
        </h1>

        <p class="text-neutral-600 max-w-2xl">
            Latest developments, policy updates, and in-depth coverage of national affairs shaping the country.
        </p>

    </div>
</section>

<!-- Featured Article -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">

        <article class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <img 
                src="https://placehold.co/800x500/1f2937/ffffff?text=Featured+Story"
                alt=""
                class="w-full h-80 lg:h-[420px] object-cover"
            />

            <div>
                <span class="text-xs font-semibold uppercase tracking-widest text-red-700">
                    Featured
                </span>

                <h2 class="text-3xl lg:text-4xl font-bold leading-tight mt-3 mb-4 tracking-tight">
                    Infrastructure Expansion Accelerates Across Key States
                </h2>

                <p class="text-neutral-600 mb-6">
                    Major development initiatives aim to modernize transport, public services, and regional connectivity nationwide.
                </p>

                <a href="#" class="text-red-700 font-semibold hover:underline">
                    Read Full Story →
                </a>
            </div>

        </article>

    </div>
</section>

<!-- Article Grid -->
<section class="pb-20">
    <div class="max-w-7xl mx-auto px-4">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

            <x-cards.vertical
                title="Policy Reforms Target Infrastructure Bottlenecks"
                excerpt="Strategic measures aim to streamline public project execution."
            />

            <x-cards.vertical
                title="Regional Development Initiatives Gain Momentum"
                excerpt="States accelerate local economic expansion efforts."
            />

            <x-cards.vertical
                title="Public Sector Investments See New Funding"
                excerpt="Budget allocations increase across priority sectors."
            />

            <x-cards.vertical
                title="Urban Planning Authorities Outline Expansion Plans"
                excerpt="Major cities prepare for next phase of modernization."
            />

            <x-cards.vertical
                title="Transport Corridors Improve National Connectivity"
                excerpt="Improved logistics networks reduce travel time."
            />

            <x-cards.vertical
                title="Energy Sector Expansion Supports Industrial Growth"
                excerpt="Infrastructure upgrades boost production capacity."
            />

        </div>

    </div>
</section>

<!-- Pagination -->
<section class="pb-24">
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex justify-center items-center gap-3 text-sm">

            <a href="#" class="px-4 py-2 border border-neutral-300 hover:bg-neutral-100 transition">
                Previous
            </a>

            <a href="#" class="px-4 py-2 bg-red-700 text-white">
                1
            </a>

            <a href="#" class="px-4 py-2 border border-neutral-300 hover:bg-neutral-100 transition">
                2
            </a>

            <a href="#" class="px-4 py-2 border border-neutral-300 hover:bg-neutral-100 transition">
                3
            </a>

            <a href="#" class="px-4 py-2 border border-neutral-300 hover:bg-neutral-100 transition">
                Next
            </a>

        </div>

    </div>
</section>


@endsection