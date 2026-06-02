<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center print:hidden">
            <h2 class="font-extrabold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 leading-tight tracking-wide flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                {{ __('Sistem Kasir') }}
            </h2>
            
            <button id="theme-toggle" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 font-semibold py-2 px-4 rounded-full shadow-sm hover:shadow-md transition-all duration-300 text-sm flex items-center gap-2">
                <span id="theme-icon">🌙</span> <span id="theme-text">Mode Gelap</span>
            </button>
        </div>
    </x-slot>

    <style>
        @media print {
            body * { visibility: hidden; }
            #area-struk, #area-struk * { visibility: visible; }
            #area-struk { display: block; position: absolute; left: 0; top: 0; width: 100%; padding: 20px; font-family: monospace; }
        }
        /* Custom scrollbar biar lebih rapi */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
    </style>

    <div class="py-8 print:hidden">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6">
                
                <div class="w-full lg:w-2/3">
                    <div class="flex justify-between items-center mb-4 px-1">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Katalog Barang</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach($products as $item)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <h4 class="font-bold text-lg text-gray-800 dark:text-gray-100 mb-1 leading-tight">{{ $item->nama_barang }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Stok tersisa: 
                                    <span class="font-bold {{ $item->stok <= 5 ? 'text-red-500' : 'text-green-500' }}">{{ $item->stok }}</span>
                                </p>
                            </div>
                            
                            <div class="flex justify-between items-center mt-2">
                                <span class="font-extrabold text-blue-600 dark:text-blue-400">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                
                                @if($item->stok > 0)
                                    <button onclick="tambahKeKeranjang({{ $item->id }}, '{{ addslashes($item->nama_barang) }}', {{ $item->harga }})" 
                                        class="bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white dark:bg-gray-700 dark:text-indigo-400 dark:hover:bg-indigo-500 dark:hover:text-white p-2 rounded-xl transition-colors duration-200 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                @else
                                    <button disabled class="bg-gray-100 text-gray-400 dark:bg-gray-700 dark:text-gray-500 p-2 rounded-xl cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="w-full lg:w-1/3">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 border-b border-gray-100 dark:border-gray-700 pb-4 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Pesanan Saat Ini
                        </h3>
                        
                        <ul id="list-keranjang" class="space-y-3 mb-6 max-h-64 overflow-y-auto pr-2 min-h-[150px]">
                            <li id="keranjang-kosong" class="text-center text-gray-400 dark:text-gray-500 py-8 text-sm italic">
                                Belum ada barang di keranjang
                            </li>
                        </ul>
                        
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400 font-semibold">Total Bayar</span>
                                <span class="text-2xl font-black text-indigo-600 dark:text-indigo-400">Rp <span id="total-harga">0</span></span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button onclick="tampilkanQRIS()" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-md shadow-green-500/30 transition-all duration-200 flex justify-center items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                                Bayar via QRIS
                            </button>
                            
                            <div class="flex gap-3">
                                <button onclick="cetakStruk()" class="w-1/2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-xl shadow transition-colors flex justify-center items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Cetak
                                </button>
                                <button onclick="resetKeranjang()" class="w-1/2 bg-red-100 hover:bg-red-200 text-red-600 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-400 font-bold py-3 px-4 rounded-xl shadow-sm transition-colors text-sm">
                                    Batalkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="qris-modal" class="hidden fixed inset-0 bg-gray-900/80 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-2xl text-center max-w-sm w-full mx-4 border border-gray-100 dark:border-gray-700 transform transition-all">
            <div class="mb-6">
                <h3 class="text-2xl font-black text-gray-800 dark:text-gray-100">Scan QRIS</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Sistem Pembayaran Digital</p>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-2xl mb-6 flex justify-center">
                <img src="https://via.placeholder.com/250?text=QRIS+Statis" alt="QRIS" class="border-4 border-white dark:border-gray-700 rounded-xl shadow-sm">
            </div>
            
            <div class="bg-indigo-50 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300 py-3 px-4 rounded-xl mb-6 font-semibold border border-indigo-100 dark:border-indigo-800">
                Total: Rp <span id="modal-total" class="font-black text-lg">0</span>
            </div>
            
            <div class="space-y-3">
                <button onclick="konfirmasiBayar()" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-md transition-all">
                    Konfirmasi Lunas & Simpan
                </button>
                <button onclick="tutupQRIS()" class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-bold py-3.5 px-6 rounded-xl transition-all">
                    Kembali
                </button>
            </div>
        </div>
    </div>

    <div id="area-struk" class="hidden text-black bg-white">
        <div style="text-align: center; margin-bottom: 15px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">SISTEM KASIR</h2>
            <p style="font-size: 12px; margin: 2px 0;">Terima kasih atas kunjungannya!</p>
            <p style="font-size: 12px; margin: 0;" id="waktu-struk"></p>
        </div>
        
        <div style="border-bottom: 2px dashed #000; margin-bottom: 10px;"></div>
        
        <ul id="struk-keranjang" style="list-style-type: none; padding: 0; margin: 0 0 10px 0; font-size: 14px;"></ul>
        
        <div style="border-bottom: 2px dashed #000; margin-bottom: 10px;"></div>
        
        <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 16px;">
            <span>TOTAL:</span>
            <span>Rp <span id="struk-total">0</span></span>
        </div>
        
        <div style="text-align: center; margin-top: 20px; font-size: 12px;">
            <p>Layanan Pelanggan</p>
            <p>Simpan struk ini sebagai bukti pembayaran</p>
        </div>
    </div>

    <script>
        // Set waktu di struk
        const now = new Date();
        document.getElementById('waktu-struk').innerText = now.toLocaleString('id-ID');

        // Logic Tema
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const themeText = document.getElementById('theme-text');

        const sunIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>`;
        const moonIcon = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>`;

        function updateToggleButton(isDark) {
            // Karena kita ganti isinya pakai kode SVG, kita ubah 'innerText' jadi 'innerHTML' khusus buat icon-nya
            if (isDark) {
                themeIcon.innerHTML = sunIcon;
                themeText.innerText = 'Mode Terang';
            } else {
                themeIcon.innerHTML = moonIcon;
                themeText.innerText = 'Mode Gelap';
            }
        }
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            updateToggleButton(true);
        } else {
            document.documentElement.classList.remove('dark');
            updateToggleButton(false);
        }

        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
                updateToggleButton(false);
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
                updateToggleButton(true);
            }
        });

        // Logic Keranjang
        let keranjang = [];
        let total = 0;

        function tambahKeKeranjang(id, nama, harga) {
            keranjang.push({ id, nama, harga });
            total += harga;
            updateLayarKeranjang();
            
            // Animasi kecil di total bayar
            const totalElement = document.getElementById('total-harga');
            totalElement.classList.add('text-green-500', 'scale-110');
            setTimeout(() => {
                totalElement.classList.remove('text-green-500', 'scale-110');
            }, 200);
        }

        function updateLayarKeranjang() {
            const listKeranjang = document.getElementById("list-keranjang");
            const strukKeranjang = document.getElementById("struk-keranjang");
            const keranjangKosong = document.getElementById("keranjang-kosong");
            
            listKeranjang.innerHTML = "";
            strukKeranjang.innerHTML = "";

            if (keranjang.length === 0) {
                listKeranjang.innerHTML = `<li id="keranjang-kosong" class="text-center text-gray-400 dark:text-gray-500 py-8 text-sm italic">Belum ada barang di keranjang</li>`;
            } else {
                keranjang.forEach((item, index) => {
                    // Tampilan list UI
                    listKeranjang.innerHTML += `
                        <li class="flex justify-between items-center bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">${item.nama}</span>
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">Rp ${item.harga.toLocaleString('id-ID')}</span>
                            </div>
                        </li>`;
                    
                    // Tampilan Struk Print
                    strukKeranjang.innerHTML += `
                        <li style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span>${item.nama}</span>
                            <span>Rp ${item.harga.toLocaleString('id-ID')}</span>
                        </li>`;
                });
            }

            document.getElementById("total-harga").innerText = total.toLocaleString('id-ID');
            document.getElementById("struk-total").innerText = total.toLocaleString('id-ID');
            document.getElementById("modal-total").innerText = total.toLocaleString('id-ID');
        }

        function tampilkanQRIS() {
            if (keranjang.length === 0) {
                alert("Pilih barang dulu ya lek sebelum bayar!");
                return;
            }
            document.getElementById("qris-modal").classList.remove("hidden");
        }

        function tutupQRIS() {
            document.getElementById("qris-modal").classList.add("hidden");
        }

        function resetKeranjang() {
            if(keranjang.length > 0 && confirm("Yakin mau membatalkan transaksi ini?")) {
                keranjang = [];
                total = 0;
                updateLayarKeranjang();
            }
        }

        function cetakStruk() {
            if (keranjang.length === 0) {
                alert("Belum ada transaksi untuk dicetak!");
                return;
            }
            window.print();
        }

        function konfirmasiBayar() {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let btn = event.target;
            let originalText = btn.innerText;

            btn.innerHTML = `<svg class="animate-spin h-5 w-5 mr-3 inline text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
            btn.disabled = true;

            fetch('{{ route('checkout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ keranjang: keranjang, total: total })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Transaksi Berhasil! Stok otomatis dikurangi.');
                    window.location.reload(); 
                } else {
                    alert('Gagal: ' + data.message);
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan jaringan.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        }
    </script>
</x-app-layout>