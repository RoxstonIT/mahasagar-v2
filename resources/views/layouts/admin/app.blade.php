<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Mahasagar</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

    <div x-data="{
        open: localStorage.getItem('sidebar') === 'closed' ? false : true
    }"
    x-init="$watch('open', value => localStorage.setItem('sidebar', value ? 'open' : 'closed'))"
    class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside 
            x-data="{ hover: false }"
            :class="(open || hover) ? 'w-64' : 'w-16'"
            @mouseenter="hover = true"
            @mouseleave="setTimeout(() => hover = false, 100)"
            class="relative bg-white shadow-md transition-all duration-300">
            
            <div class="relative">
    
                <button @click="open = !open"
                        class="absolute top-0 -right-8 z-50
                            bg-[#ec1e20] text-white
                            w-8 h-8 rounded-r-lg shadow-md
                            flex items-center justify-center
                            hover:opacity-90 transition-all">
    
                    <span x-show="open || hover">‹</span>
                    <span x-show="!open && !hover">›</span>
    
                </button>
    
            </div>            

            <div class="p-4 border-b flex items-center justify-center">

                <img x-show="open || hover"
                    x-transition
                    src="{{ asset('images/logo/logo.png') }}"
                    class="w-[175px]">

                <img x-show="!open && !hover"
                    x-transition
                    src="{{ asset('favicon.ico') }}"
                    class="w-8 h-8">

            </div>

            <nav class="p-4 space-y-6">

                @php $user = auth()->user(); @endphp

                @foreach(config('admin_menu') as $group)

                    <div>

                        <p class="text-xs text-gray-400 uppercase mb-2" x-show="open || hover">
                            {{ $group['section'] }}
                        </p>

                        <div class="space-y-1">

                            @foreach($group['items'] as $item)

                                @if(!$item['permission'] || $user->hasPermission($item['permission']))

                                    <a href="{{ route($item['route']) }}"
                                        class="
                                                flex items-center 
                                                rounded gap-2
                                                {{ request()->routeIs(str_replace('.index', '.*', $item['route'])) 
                                                    ? 'bg-[#ec1e20] text-white' 
                                                    : 'hover:bg-gray-100' }}
                                        "
                                        :class="open || hover ? 'px-3 py-2 justify-start' : 'px-1 py-1 justify-center'"
                                    >

                                        <i data-lucide="{{ $item['icon'] }}" :class="open || hover ? 'w-4 h-4' : 'w-4 h-6'"></i>

                                        <span x-show="open || hover">{{ $item['label'] }}</span>
                                    </a>

                                @endif

                            @endforeach

                        </div>

                    </div>

                @endforeach

            </nav>

        </aside>

        {{-- Right Panel --}}
        <div class="flex-1 flex flex-col">

            {{-- Top Navbar --}}
            <header class="bg-white shadow-sm px-10 py-4 flex items-center justify-between">

                <h2 class="text-lg font-semibold">Admin Panel</h2>

                <div x-data="{ openProfile: false }" class="relative">

                    <button @click="openProfile = !openProfile"
                            class="flex items-center gap-2 focus:outline-none">

                        {{-- Avatar --}}
                        <div class="w-8 h-8 rounded-full bg-[#ec1e20] text-white flex items-center justify-center text-sm font-semibold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        {{-- Name --}}
                        <span class="text-sm text-gray-700">
                            {{ auth()->user()->name }}
                        </span>

                    </button>

                    {{-- Dropdown --}}
                    <div x-show="openProfile"
                        @click.outside="openProfile = false"
                        x-transition
                        class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-md overflow-hidden">

                        <a href="#"
                        class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-6">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>

        </div>

    </div>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: @json(session('success')),
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
        });
    });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                confirmButtonColor: '#ec1e20'
            });
        });
    </script>
    @endif

</body>
</html>