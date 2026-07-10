<x-guest-layout>
    <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white dark:bg-slate-900 shadow-xl border border-slate-100 dark:border-slate-800 rounded-3xl">
        
        <div class="mb-8 text-center">
            <div class="inline-flex bg-indigo-600 p-3 rounded-2xl text-white shadow-md shadow-indigo-500/20 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Selamat Datang Kembali</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Silakan masuk untuk mengelola kasir</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kata Sandi (Password)</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 dark:border-slate-800 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-slate-950">
                    <span class="ml-2 font-semibold text-slate-600 dark:text-slate-400">Ingat Akun</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                        Lupa Sandi?
                    </a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-md shadow-indigo-500/20 transition-all duration-200 flex justify-center items-center">
                    Masuk ke Sistem
                </button>
            </div>
            
            @if (Route::has('register'))
                <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-4">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Daftar Sekarang</a>
                </p>
            @endif
        </form>
    </div>
</x-guest-layout>