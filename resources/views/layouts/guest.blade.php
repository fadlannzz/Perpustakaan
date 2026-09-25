<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIPUS - Perpustakaan Digital') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 dark:text-slate-100 bg-slate-900 min-h-screen selection:bg-emerald-500 selection:text-white relative overflow-x-hidden flex items-center justify-center p-4">
        <!-- Ambient Background Glows -->
        <div class="fixed top-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="fixed bottom-0 right-1/4 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="w-full max-w-md my-8 relative z-10">
            <!-- Brand Logo & Title -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex flex-col items-center group">
                    <x-application-logo class="w-14 h-14 shadow-lg shadow-emerald-500/20 rounded-2xl transition-transform group-hover:scale-105 duration-200" />
                    <span class="mt-4 text-2xl font-extrabold text-white tracking-tight">SIPUS</span>
                    <span class="text-xs uppercase font-semibold text-emerald-400 tracking-widest mt-0.5">Sistem Perpustakaan Digital</span>
                </a>
            </div>

            <!-- Main Card Container -->
            <div class="bg-slate-800/90 backdrop-blur-xl border border-slate-700/80 shadow-2xl rounded-3xl p-6 sm:p-8">
                {{ $slot }}
            </div>

            <p class="text-center text-xs text-slate-500 mt-6">
                &copy; {{ date('Y') }} SIPUS &bull; Aplikasi Pengelolaan Koleksi & Peminjaman
            </p>
        </div>
    </body>
</html>
