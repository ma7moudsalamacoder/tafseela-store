<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tafsela | تفصيلة - الرئيسية' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="transition-colors duration-300">

    <x-header :cartCount="$cartCount ?? 0" :wishlistCount="$wishlistCount ?? 0" />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
</body>

</html>
