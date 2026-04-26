<header class="border-b border-neutral-200 bg-white">

    <!-- Top Utility Bar -->
    <div class="bg-neutral-100 text-xs">
        <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
            <span>{{ now()->format('l, d M Y') }}</span>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:underline">Login / Register</a>
                <a href="javascript:;" class="hover:underline"> | </a>
                <a href="#" class="font-semibold text-red-700 hover:underline">Subscribe</a>
            </div>
        </div>
    </div>

    <!-- Brand Section -->
    <div class="max-w-7xl mx-auto px-4 py-5 text-center">
        <a href="{{ route('home') }}">
            <!-- <h1 class="text-3xl font-bold tracking-tight">Mahasagar</h1>
            <p class="text-xs text-neutral-500 mt-1 uppercase tracking-widest">Mahasagar Samachar</p> -->
            <img src="{{ asset('images/logo/logo.png') }}" alt="Mahasagar Logo" class="mx-auto h-24">
        </a>
    </div>

</header>

<!-- Navigation -->
<nav class="sticky top-0 bg-red-700 text-white z-50 shadow-md">

    <div class="max-w-7xl mx-auto px-4">

        <!-- Desktop Menu -->
        <div class="hidden md:flex justify-center gap-10 py-3 text-sm font-semibold tracking-wide">
            
            @php $isHomePage = request()->routeIs('home'); @endphp

            <a href="/" class="relative group">
                <span class=" transition duration-200 {{ $isHomePage ? 'text-black font-bold' : 'group-hover:text-black' }} ">
                    Home
                </span>
                <span class="absolute left-0 -bottom-1 h-[2px] bg-black transition-all duration-300 {{ $isHomePage ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
            
            @foreach($navCategories as $category)
            
                @php 
                    $isActive = (request()->routeIs('category.show')  && request()->route('slug') === $category->slug) ||
                                (request()->routeIs('news.show') && isset($article) && $article->category_id === $category->id);
                @endphp
                
                <a href="{{ route('category.show', $category->slug) }}" class="relative group">
                    
                    <span class=" transition duration-200 {{ $isActive ? 'text-black font-bold' : 'group-hover:text-black' }} ">
                        {{ $category->name }}
                    </span>

                    <span class="absolute left-0 -bottom-1 h-[2px] bg-black transition-all duration-300 {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>

                </a>

            @endforeach

        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex justify-between items-center py-3 text-white">
            <button class="text-sm font-medium">
                ☰ Mahasagar
            </button>
            <span class="text-sm font-medium">
                Search
            </span>
        </div>

    </div>
</nav>