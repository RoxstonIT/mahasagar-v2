@extends('layouts.web.app')

@section('title', 'Home')

@section('content')

<!-- Hero Section -->
<section class="bg-neutral-100 py-12">
    <div class="max-w-7xl mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Featured Article (2 columns on desktop) -->
            @php $hero = $articles->first(); @endphp
            <article class="lg:col-span-2">
                
                <img 
                    src="{{ $hero?->banner ? asset('storage/'.$hero->banner) : 'https://placehold.co/400x300' }}"
                    alt=""
                    class="w-full h-80 lg:h-[390px] object-cover"
                />
        
                <span class="mt-6 block text-xs font-semibold uppercase tracking-widest text-red-700">
                    {{ $hero?->category->name ?? 'General' }}
                </span>
                <h2 class="text-3xl lg:text-5xl font-bold leading-tight mb-4 tracking-tight">
                    <a href="{{ route('news.show', $hero->slug) }}">
                        {{ $hero?->title }}
                    </a>
                </h2>
                <p class="text-neutral-600 text-sm lg:text-base">
                    {{ $hero?->short_article }}
                </p>
            </article>

            <!-- Secondary Stories -->
            <div class="space-y-6 lg:h-[550px] overflow-y-auto">
                
                <x-web.cards.horizontal
                    title="Technology Innovation Driving Rural Transformation"
                    excerpt="New digital initiatives aim to bridge the urban-rural divide."
                />

                <x-web.cards.horizontal
                    title="Markets React to Global Economic Signals"
                    excerpt="Investors monitor international developments closely."
                />

                <x-web.cards.horizontal
                    title="Cultural Revival Through Contemporary Art"
                    excerpt="Artists reinterpret heritage in modern forms."
                />

                <x-web.cards.horizontal
                    title="Cultural Revival Through Contemporary Art"
                    excerpt="Artists reinterpret heritage in modern forms."
                />

                <x-web.cards.horizontal
                    title="Cultural Revival Through Contemporary Art"
                    excerpt="Artists reinterpret heritage in modern forms."
                />

                <x-web.cards.horizontal
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
    
        <x-web.section-header title="National" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <x-web.cards.featured
                class="lg:col-span-2"
                title="Infrastructure Expansion Reshaping Urban Landscapes"
                excerpt="Major infrastructure projects aim to modernize transport and public services across key cities."
            />

            <div class="space-y-6">
                <x-web.cards.horizontal
                    title="Education Reforms Focus on Digital Inclusion"
                    excerpt="Government initiatives aim to enhance digital access nationwide."
                />

                <x-web.cards.horizontal
                    title="Agricultural Policy Updates Announced"
                    excerpt="Farmers anticipate benefits from revised subsidy structures."
                />

                <x-web.cards.horizontal
                    title="State Elections See Record Voter Turnout"
                    excerpt="Analysts predict shifting political dynamics."
                />

                <x-web.cards.horizontal
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

        <x-web.section-header title="International" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <x-web.cards.featured
                class="lg:col-span-2"
                title="Global Leaders Convene to Address Climate Policy"
                excerpt="International cooperation remains central to long-term sustainability efforts."
            />

            <div class="space-y-6">
                <x-web.cards.horizontal
                    title="Trade Agreements Reshape Regional Alliances"
                    excerpt="Economic diplomacy gains renewed momentum."
                />

                <x-web.cards.horizontal
                    title="Energy Markets Respond to Strategic Shifts"
                    excerpt="Oil and gas sectors see notable volatility."
                />

                <x-web.cards.horizontal
                    title="Cultural Diplomacy Strengthens Cross-Border Ties"
                    excerpt="Soft power initiatives expand across continents."
                />

                <x-web.cards.horizontal
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

        <x-web.section-header title="Business" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <x-web.cards.featured
                class="lg:col-span-2"
                title="Indian Markets Close Higher Amid Global Optimism"
                excerpt="Strong investor confidence boosts key indices across sectors."
            />

            <div class="space-y-6">
                <x-web.cards.horizontal
                    title="Startup Ecosystem Attracts Foreign Investment"
                    excerpt="Venture capital inflows continue to rise."
                />

                <x-web.cards.horizontal
                    title="Rupee Stability Eases Import Pressures"
                    excerpt="Currency resilience strengthens trade outlook."
                />

                <x-web.cards.horizontal
                    title="Banking Sector Reports Improved Quarterly Results"
                    excerpt="Profit margins reflect steady economic recovery."
                />

                <x-web.cards.horizontal
                    title="Energy Stocks See Renewed Momentum"
                    excerpt="Oil and renewables sectors show upward movement."
                />
            </div>

        </div>

    </div>
</section>

<!-- Technology Section -->
<section class="bg-neutral-100 py-12">
    <div class="max-w-7xl mx-auto px-4">

        <x-web.section-header title="Technology" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <x-web.cards.featured
                class="lg:col-span-2"
                title="AI Adoption Accelerates Across Industries"
                excerpt="Businesses leverage artificial intelligence for enhanced productivity and innovation."
            />

            <div class="space-y-6">
                <x-web.cards.horizontal
                    title="Digital Infrastructure Expands Nationwide"
                    excerpt="New projects aim to improve connectivity and access."
                />

                <x-web.cards.horizontal
                    title="Cybersecurity Initiatives Strengthen Data Protection"
                    excerpt="Organizations invest in robust security frameworks."
                />

                <x-web.cards.horizontal
                    title="Startups Pioneer Next-Gen Solutions"
                    excerpt="Entrepreneurs drive technological advancements."
                />

                <x-web.cards.horizontal
                    title="Government Launches Tech Skill Programs"
                    excerpt="Training initiatives support workforce transformation."
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

<!-- Culture Section -->
<section class="px-4 py-16">
    <div class="max-w-7xl mx-auto px-4">

        <x-web.section-header title="Culture" />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <x-web.cards.vertical
                title="Heritage Festivals Celebrate Local Traditions"
                excerpt="Communities across India revive age-old customs through vibrant festivals."
            />

            <x-web.cards.vertical
                title="Contemporary Artists Redefine Indian Art"
                excerpt="Modern interpretations blend tradition with innovation in galleries nationwide."
            />

            <x-web.cards.vertical
                title="Literature Events Spotlight Emerging Voices"
                excerpt="Young authors gain recognition at national book fairs and readings."
            />

            <x-web.cards.vertical
                title="Music Scene Thrives with Fusion Genres"
                excerpt="Artists experiment with blending classical and modern sounds."
            />

            <x-web.cards.vertical
                title="Culinary Heritage Inspires New Trends"
                excerpt="Chefs reinterpret regional recipes for global audiences."
            />

            <x-web.cards.vertical
                title="Film Industry Explores Social Narratives"
                excerpt="Directors tackle contemporary issues through creative storytelling."
            />

        </div>

    </div>
</section>

@endsection