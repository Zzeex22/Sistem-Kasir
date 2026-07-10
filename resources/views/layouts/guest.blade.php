<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistem Kasir</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 dark:bg-slate-950 flex flex-col min-h-screen">
        
        <div class="flex-grow flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <!-- Tempat form login/register dirender -->
            <div class="w-full sm:max-w-md">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer Kecil -->
        <div class="py-6 text-center text-sm text-slate-500 dark:text-slate-400">
            &copy; {{ date('Y') }} Sistem Kasir.
        </div>
    </body>
</html>