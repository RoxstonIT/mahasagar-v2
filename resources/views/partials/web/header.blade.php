<header class="border-b border-neutral-200 bg-white">

    <!-- Top Utility Bar -->
    <div class="bg-neutral-100 text-xs">
        <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
            <span>{{ now()->format('l, d M Y') }}</span>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:underline">Login</a>
                <a href="#" class="font-semibold text-red-700 hover:underline">Subscribe</a>
            </div>
        </div>
    </div>

    <!-- Brand Section -->
    <div class="max-w-7xl mx-auto px-4 py-5 text-center">
        <a href="/" >
            <!-- <h1 class="text-3xl font-bold tracking-tight">Mahasagar</h1>
            <p class="text-xs text-neutral-500 mt-1 uppercase tracking-widest">
                Voices Beyond The Horizon
            </p> -->
            <img src="{{ asset('images/logo/logo.png') }}" alt="Mahasagar Logo" class="mx-auto h-24">
        </a>
    </div>

</header>

<!-- Navigation -->
<nav class="sticky top-0 bg-red-700 text-white z-50 shadow-md">

    <div class="max-w-7xl mx-auto px-4">

        <!-- Desktop Menu -->
        <div class="hidden md:flex justify-center gap-10 py-3 text-sm font-semibold tracking-wide">
            <a href="#" class="relative group">
                <span class="group-hover:text-black transition duration-200">
                    National
                </span>
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="relative group">
                <span class="group-hover:text-black transition duration-200">
                    International
                </span>
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="relative group">
                <span class="group-hover:text-black transition duration-200">
                    Business
                </span>
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="relative group">
                <span class="group-hover:text-black transition duration-200">
                    Technology
                </span>
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="relative group">
                <span class="group-hover:text-black transition duration-200">
                    Opinion
                </span>
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="#" class="relative group">
                <span class="group-hover:text-black transition duration-200">
                    Culture
                </span>
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-black transition-all duration-300 group-hover:w-full"></span>
            </a>
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