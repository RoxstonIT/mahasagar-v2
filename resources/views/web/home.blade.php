@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Hero Section -->
<section class="bg-neutral-100 py-12">
    <div class="max-w-7xl mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Featured Article (2 columns on desktop) -->
            <article class="lg:col-span-2">
                
                <img 
                    src="https://placehold.co/400x300/374151/ffffff?text=Story"
                    alt=""
                    class="w-full h-80 lg:h-[390px] object-cover"
                />
        
                <span class="mt-6 block text-xs font-semibold uppercase tracking-widest text-red-700">
                    Analysis
                </span>
                <h2 class="text-3xl lg:text-5xl font-bold leading-tight mb-4 tracking-tight">
                    India's Strategic Role in a Changing Global Order
                </h2>
                <p class="text-neutral-600 text-sm lg:text-base">
                    As geopolitical shifts reshape alliances, India's influence continues to expand across economic and diplomatic fronts.
                </p>
            </article>

            <!-- Secondary Stories -->
            <div class="space-y-6 lg:h-[550px] overflow-y-auto">
                
                <x-cards.horizontal
                    title="Technology Innovation Driving Rural Transformation"
                    excerpt="New digital initiatives aim to bridge the urban-rural divide."
                />

                <x-cards.horizontal
                    title="Markets React to Global Economic Signals"
                    excerpt="Investors monitor international developments closely."
                />

                <x-cards.horizontal
                    title="Cultural Revival Through Contemporary Art"
                    excerpt="Artists reinterpret heritage in modern forms."
                />

                <x-cards.horizontal
                    title="Cultural Revival Through Contemporary Art"
                    excerpt="Artists reinterpret heritage in modern forms."
                />

                <x-cards.horizontal
                    title="Cultural Revival Through Contemporary Art"
                    excerpt="Artists reinterpret heritage in modern forms."
                />

                <x-cards.horizontal
                    title="Cultural Revival Through Contemporary Art"
                    excerpt="Artists reinterpret heritage in modern forms."
                />


            </div>

        </div>
        
    </div>
</section>

<!-- Breaking News Strip -->
<section class="bg-red-700 text-white py-8">
    <div class="max-w-7xl mx-auto px-4 py-3">

        <div class="flex flex-col md:flex-row md:items-center gap-3">

            <span class="font-bold uppercase text-sm tracking-wide">
                Breaking
            </span>

            <div class="flex-1 space-y-2 md:space-y-0 md:flex md:gap-6 text-sm">
                <a href="#" class="hover:underline">
                    Parliament debates key economic reforms amid rising inflation.
                </a>
                <a href="#" class="hover:underline">
                    Global markets fluctuate following international policy shifts.
                </a>
                <a href="#" class="hover:underline">
                    Major technology summit announces cross-border collaborations.
                </a>
            </div>

        </div>

    </div>
</section>

<!-- National Section -->
<section class="px-4 py-12">
    <div class="max-w-7xl mx-auto px-4">
    
        <x-section-header title="National" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <x-cards.featured
                class="lg:col-span-2"
                title="Infrastructure Expansion Reshaping Urban Landscapes"
                excerpt="Major infrastructure projects aim to modernize transport and public services across key cities."
            />

            <div class="space-y-6">
                <x-cards.horizontal
                    title="Education Reforms Focus on Digital Inclusion"
                    excerpt="Government initiatives aim to enhance digital access nationwide."
                />

                <x-cards.horizontal
                    title="Agricultural Policy Updates Announced"
                    excerpt="Farmers anticipate benefits from revised subsidy structures."
                />

                <x-cards.horizontal
                    title="State Elections See Record Voter Turnout"
                    excerpt="Analysts predict shifting political dynamics."
                />

                <x-cards.horizontal
                    title="State Elections See Record Voter Turnout"
                    excerpt="Analysts predict shifting political dynamics."
                />
            </div>

        </div>
        
    </div>
</section>

<!-- International Section -->
<section class="bg-neutral-100 py-12">
    <div class="max-w-7xl mx-auto px-4">

        <x-section-header title="International" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <x-cards.featured
                class="lg:col-span-2"
                title="Global Leaders Convene to Address Climate Policy"
                excerpt="International cooperation remains central to long-term sustainability efforts."
            />

            <div class="space-y-6">
                <x-cards.horizontal
                    title="Trade Agreements Reshape Regional Alliances"
                    excerpt="Economic diplomacy gains renewed momentum."
                />

                <x-cards.horizontal
                    title="Energy Markets Respond to Strategic Shifts"
                    excerpt="Oil and gas sectors see notable volatility."
                />

                <x-cards.horizontal
                    title="Cultural Diplomacy Strengthens Cross-Border Ties"
                    excerpt="Soft power initiatives expand across continents."
                />

                <x-cards.horizontal
                    title="Cultural Diplomacy Strengthens Cross-Border Ties"
                    excerpt="Soft power initiatives expand across continents."
                />
            </div>

        </div>
        
    </div>
</section>

<!-- Business Section -->
<section class="px-4 py-12">
    <div class="max-w-7xl mx-auto px-4">

        <x-section-header title="Business" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <x-cards.featured
                class="lg:col-span-2"
                title="Indian Markets Close Higher Amid Global Optimism"
                excerpt="Strong investor confidence boosts key indices across sectors."
            />

            <div class="space-y-6">
                <x-cards.horizontal
                    title="Startup Ecosystem Attracts Foreign Investment"
                    excerpt="Venture capital inflows continue to rise."
                />

                <x-cards.horizontal
                    title="Rupee Stability Eases Import Pressures"
                    excerpt="Currency resilience strengthens trade outlook."
                />

                <x-cards.horizontal
                    title="Banking Sector Reports Improved Quarterly Results"
                    excerpt="Profit margins reflect steady economic recovery."
                />

                <x-cards.horizontal
                    title="Energy Stocks See Renewed Momentum"
                    excerpt="Oil and renewables sectors show upward movement."
                />
            </div>

        </div>

    </div>
</section>

<!-- Opinion Section -->
<section class="bg-neutral-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">

        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold tracking-tight">
                Opinion
            </h2>
            <a href="#" class="text-sm text-neutral-300 hover:underline">
                View All
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <article>
                <h3 class="text-2xl font-bold mb-4 leading-tight">
                    The Future of Democratic Institutions in the Digital Era
                </h3>
                <p class="text-neutral-300 text-sm">
                    Emerging technologies are redefining governance, transparency, and public participation.
                </p>
            </article>

            <article>
                <h3 class="text-2xl font-bold mb-4 leading-tight">
                    Reimagining Education for a Global Generation
                </h3>
                <p class="text-neutral-300 text-sm">
                    Policy reforms must adapt to rapid socio-economic transformation.
                </p>
            </article>

            <article>
                <h3 class="text-2xl font-bold mb-4 leading-tight">
                    India's Cultural Identity in a Globalized World
                </h3>
                <p class="text-neutral-300 text-sm">
                    Tradition and innovation coexist in shaping modern society.
                </p>
            </article>

        </div>

    </div>
</section>

@endsection