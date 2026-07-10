<x-guest-layout>
    <div class="w-full px-8 py-8 bg-white dark:bg-slate-900 shadow-xl border border-slate-100 dark:border-slate-800 rounded-3xl">
        
        <!-- Header Halaman Register -->
        <div class="mb-8 text-center">
            <div class="inline-flex bg-indigo-600 p-3 rounded-2xl text-white shadow-md shadow-indigo-500/20 mb-4">
                <!-- Ikon Tambah User -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Buat Akun Baru</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Daftarkan akun untuk masuk ke sistem</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kata Sandi (Password)</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" 
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Action Button -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-md shadow-indigo-500/20 transition-all duration-200 flex justify-center items-center">
                    Daftar Sekarang
                </button>
            </div>
            
            <!-- Link Login -->
            <p class="text-center text-sm text-slate-500 dark:text-slate-400 mt-4">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Masuk di sini</a>
            </p>
        </form>
    </div>
</x-guest-layout>