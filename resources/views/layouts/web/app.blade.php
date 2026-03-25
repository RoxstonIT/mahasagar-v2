<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mahasagar')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

</head>
<body class="bg-neutral-50 text-neutral-900 antialiased">

    @include('partials.web.header')

    <main>
        @yield('content')
    </main>

    @include('partials.web.footer')

</body>
</html>
