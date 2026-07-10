<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Kasir Modern</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-['Figtree']">

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between border-b border-slate-200/60 dark:border-slate-800/60">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-md shadow-indigo-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="font-extrabold text-xl tracking-tight">Sistem<span class="text-indigo-600 dark:text-indigo-400">Kasir</span></span>
        </div>

        <nav class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition-all text-sm">Masuk Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-slate-900 dark:bg-slate-100 hover:bg-slate-800 dark:hover:bg-slate-200 text-white dark:text-slate-900 font-bold py-2.5 px-5 rounded-xl text-sm transition-all shadow-sm">Daftar Akun</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 text-center">
        <div class="max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 mb-6 border border-indigo-100 dark:border-indigo-500/20">
                🚀 Aplikasi Kasir Berbasis Web Modern v2.0
            </span>
            <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 dark:from-white dark:via-indigo-200 dark:to-white leading-[1.15] mb-6">
                Kelola Transaksi Bisnis <br><span class="text-indigo-600 dark:text-indigo-400">Lebih Cepat & Otomatis</span>
            </h1>
            <p class="text-lg text-slate-500 dark:text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                Sistem Point of Sale (POS) cerdas yang dirancang untuk mempercepat transaksi kasir, manajemen sisa stok barang, pembayaran instan QRIS, hingga cetak struk pembukuan otomatis.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-base font-bold py-4 px-8 rounded-2xl shadow-lg shadow-indigo-500/20 hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2">
                    Mulai Transaksi Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-24 text-left max-w-6xl mx-auto">
            <div class="bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800/60 p-6 rounded-2xl shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Hitung Otomatis</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Keranjang belanja dinamis berbasis JavaScript yang langsung menjumlahkan total harga belanjaan secara realtime tanpa reload.</p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800/60 p-6 rounded-2xl shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Integrasi QRIS</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Mendukung tampilan sistem pembayaran non-tunai berbasis QR Code pop-up modal untuk mempermudah transaksi digital.</p>
            </div>
            <div class="bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800/60 p-6 rounded-2xl shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Cetak Struk Instan</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Fitur cetak nota struk thermal langsung ke mesin printer kasir menggunakan sinkronisasi CSS Media Print terstruktur.</p>
            </div>
        </div>
    </main>
</body>
</html>