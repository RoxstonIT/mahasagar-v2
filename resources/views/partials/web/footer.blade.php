<footer class="bg-neutral-50 border-t border-neutral-200 mt-24">

    <div class="max-w-7xl mx-auto px-4 py-16">

        <!-- Top Footer Grid -->
        <div class="grid gap-12 md:grid-cols-4">

            <!-- Brand -->
            <div>
                <!-- <h2 class="text-2xl font-bold tracking-tight mb-4">
                    Mahasagar
                </h2> -->
                <img src="{{ asset('images/logo/logo.png') }}" alt="Mahasagar Logo" class="h-20 mb-4">
                <p class="text-sm text-neutral-600 leading-relaxed">
                    Independent journalism inspired by Indian depth and global perspective.
                </p>
            </div>

            <!-- Sections -->
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-widest text-neutral-500 mb-4">
                    Sections
                </h3>
                <ul class="space-y-3 text-sm text-neutral-700">
                    <li><a href="#" class="hover:text-red-700 transition">National</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">International</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">Business</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">Technology</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">Opinion</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">Culture</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-widest text-neutral-500 mb-4">
                    Company
                </h3>
                <ul class="space-y-3 text-sm text-neutral-700">
                    <li><a href="#" class="hover:text-red-700 transition">About Us</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">Contact</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">Editorial Policy</a></li>
                    <li><a href="#" class="hover:text-red-700 transition">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-widest text-neutral-500 mb-4">
                    Newsletter
                </h3>

                <p class="text-sm text-neutral-600 mb-4">
                    Get curated insights delivered directly to your inbox.
                </p>

                <div class="flex">
                    <input 
                        type="email"
                        placeholder="Your email"
                        class="flex-1 border border-neutral-300 px-3 py-2 text-sm focus:outline-none focus:border-red-700"
                    >
                    <button class="bg-red-700 text-white px-4 text-sm font-semibold">
                        Subscribe
                    </button>
                </div>
            </div>

        </div>

    </div>

    <!-- Bottom Strip -->
    <div class="border-t border-neutral-200 py-6 text-center text-xs text-neutral-500">
        © {{ date('Y') }} Mahasagar. All rights reserved.
    </div>

</footer>