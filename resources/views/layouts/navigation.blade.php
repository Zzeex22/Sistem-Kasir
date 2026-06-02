<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 sticky top-0 z-40 shadow-sm print:hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="bg-indigo-600 dark:bg-indigo-500 p-2.5 rounded-xl group-hover:bg-indigo-700 dark:group-hover:bg-indigo-400 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="font-black text-xl text-gray-800 dark:text-white tracking-tight hidden md:block">
                            Sistem<span class="text-indigo-600 dark:text-indigo-400">Kasir</span>
                        </span>
                    </a>
                </div>

                @php
                    $navItems = [
                        ['name' => '💻 Mesin Kasir', 'route' => 'dashboard', 'active' => request()->routeIs('dashboard')],
                        ['name' => '📦 Stok Barang', 'route' => 'barang.index', 'active' => request()->routeIs('barang.*')],
                        ['name' => '📜 Riwayat', 'route' => 'riwayat.index', 'active' => request()->routeIs('riwayat.*')],
                    ];
                @endphp

                <div class="hidden sm:flex sm:items-center space-x-2 ml-4">
                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}" 
                           class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 
                           {{ $item['active'] 
                              ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 shadow-sm' 
                              : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-800 dark:hover:text-gray-200' }}">
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150 gap-2">
                            <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-700 dark:text-indigo-400 font-black text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            
                            <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-semibold text-gray-700 dark:text-gray-300">
                            {{ __('Profil Akun') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 dark:text-red-400 font-semibold hover:bg-red-50 dark:hover:bg-red-900/20">
                                {{ __('Keluar (Log Out)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1 px-4">
            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}" 
                   class="block px-4 py-3 rounded-lg text-base font-bold transition-colors 
                   {{ $item['active'] 
                      ? 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400' 
                      : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                    {{ $item['name'] }}
                </a>
            @endforeach
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-6 flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-700 dark:text-indigo-400 font-black text-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-bold text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg text-base font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800">
                    Profil Akun
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" 
                       class="block px-4 py-2 rounded-lg text-base font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                        Keluar
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>