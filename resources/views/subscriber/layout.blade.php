<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Subscriber Account') - Mahasagar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-neutral-50 text-neutral-900 antialiased">

    @include('partials.web.header')

    <main class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-[260px_1fr] gap-8">
                <aside class="bg-white border border-neutral-200 p-6 h-fit">
                    <p class="text-xs font-semibold uppercase tracking-widest text-[#ec1e20] mb-2">
                        Subscriber
                    </p>

                    <h2 class="text-xl font-bold mb-6">
                        {{ auth()->user()->name }}
                    </h2>

                    <nav class="space-y-1 text-sm">
                        <a href="{{ route('subscriber.dashboard') }}"
                           class="block px-3 py-2 border-l-4 {{ request()->routeIs('subscriber.dashboard') ? 'border-[#ec1e20] bg-neutral-100 font-semibold' : 'border-transparent hover:bg-neutral-100' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('subscriber.saved-articles.index') }}"
                           class="block px-3 py-2 border-l-4 {{ request()->routeIs('subscriber.saved-articles.*') ? 'border-[#ec1e20] bg-neutral-100 font-semibold' : 'border-transparent hover:bg-neutral-100' }}">
                            Saved Articles
                        </a>

                        <a href="{{ route('subscriber.liked-articles.index') }}"
                           class="block px-3 py-2 border-l-4 {{ request()->routeIs('subscriber.liked-articles.*') ? 'border-[#ec1e20] bg-neutral-100 font-semibold' : 'border-transparent hover:bg-neutral-100' }}">
                            Liked Articles
                        </a>

                        <a href="{{ route('subscriber.comments.index') }}"
                           class="block px-3 py-2 border-l-4 {{ request()->routeIs('subscriber.comments.*') ? 'border-[#ec1e20] bg-neutral-100 font-semibold' : 'border-transparent hover:bg-neutral-100' }}">
                            My Comments
                        </a>

                        <span class="block px-3 py-2 border-l-4 border-transparent text-neutral-400">
                            Profile
                        </span>

                        <form method="POST" action="{{ route('subscriber.logout') }}" class="pt-3">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 border-l-4 border-transparent text-[#ec1e20] font-semibold hover:bg-neutral-100">
                                Logout
                            </button>
                        </form>
                    </nav>
                </aside>

                <section>
                    @yield('content')
                </section>
            </div>
        </div>
    </main>

    @include('partials.web.footer')

</body>
</html>
