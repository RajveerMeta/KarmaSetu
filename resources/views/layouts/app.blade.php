<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KarmaSetu - Every good intention needs a bridge</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Bridge visual styles */
        .bridge-line {
            position: absolute;
            z-index: 0;
            border: 1px dashed var(--color-gold);
            opacity: 0.5;
        }
        .bridge-path {
            stroke: var(--color-gold);
            stroke-width: 1.5;
            stroke-dasharray: 4 4;
            fill: none;
            opacity: 0.6;
        }
    </style>
</head>
<body class="bg-ivory text-charcoal font-sans antialiased overflow-x-hidden">
    
    <x-navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
