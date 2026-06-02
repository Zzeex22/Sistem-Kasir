<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center print:hidden">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Sistem Kasir') }}
            </h2>
            <button id="theme-toggle" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded shadow transition text-sm flex items-center gap-2">
                <span id="theme-icon">🌙</span> <span id="theme-text">Mode Gelap</span>
            </button>
        </div>
    </x-slot>

    <style>
        @media print {
            body * { visibility: hidden; }
            #area-struk, #area-struk * { visibility: visible; }
            #area-struk { display: block; position: absolute; left: 0; top: 0; width: 100%; padding: 20px; }
        }
    </style>

    <div class="py-12 print:hidden">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">Daftar Barang</h3>
                    <div class="space-y-3">
                        @foreach($products as $item)
                        <div class="flex justify-between items-center border-b border-gray-100 dark:border-gray-700 pb-2">
                            <div>
                                <p class="font-semibold text-gray-700 dark:text-gray-300">{{ $item->nama_barang }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($item->harga, 0, ',', '.') }} | Stok: <span class="font-bold {{ $item->stok == 0 ? 'text-red-500' : 'text-green-600 dark:text-green-400' }}">{{ $item->stok }}</span></p>
                            </div>
                            @if($item->stok > 0)
                                <button onclick="tambahKeKeranjang({{ $item->id }}, '{{ $item->nama_barang }}', {{ $item->harga }})" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-1 px-3 rounded shadow transition">
                                    Tambah
                                </button>
                            @else
                                <button disabled class="bg-gray-400 text-white text-sm font-bold py-1 px-3 rounded cursor-not-allowed">
                                    Habis
                                </button>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">Keranjang Belanja</h3>
                    <ul id="list-keranjang" class="space-y-2 mb-4 text-gray-600 dark:text-gray-300 min-h-[100px]">
                        </ul>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4 flex justify-between">
                            Total: <span class="text-blue-600 dark:text-blue-400">Rp <span id="total-harga">0</span></span>
                        </h3>
                        <div class="flex gap-2 mb-3">
                            <button onclick="tampilkanQRIS()" class="w-1/2 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded shadow transition">
                                Bayar via QRIS
                            </button>
                            <button onclick="cetakStruk()" class="w-1/2 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded shadow transition">
                                Cetak Struk
                            </button>
                        </div>
                        <button onclick="resetKeranjang()" class="w-full bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 text-red-600 dark:text-red-300 font-bold py-2 px-4 rounded shadow transition text-sm">
                            Batalkan Transaksi
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="qris-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-70 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl text-center max-w-sm w-full">
            <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200">Scan QRIS 3 All Store</h3>
            <img src="https://via.placeholder.com/200?text=QRIS+Statis" alt="QRIS" class="mx-auto mb-4 border-2 border-gray-200 dark:border-gray-600 rounded-lg">
            
            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">Pastikan kustomer sudah membayar sejumlah <b class="text-gray-800 dark:text-gray-200">Rp <span id="modal-total">0</span></b></p>
            
            <button onclick="konfirmasiBayar()" class="w-full mb-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition">
                Konfirmasi Lunas & Simpan
            </button>
            <button onclick="tutupQRIS()" class="w-full bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-6 rounded shadow transition">
                Tutup / Batal
            </button>
        </div>
    </div>

    <div id="area-struk" class="hidden font-mono text-black bg-white">
        <h2 class="text-center font-bold text-2xl">3 ALL STORE</h2>
        <p class="text-center text-sm mb-2">Terima kasih telah berbelanja!</p>
        <div class="border-b-2 border-dashed border-gray-400 mb-2"></div>
        <ul id="struk-keranjang" class="mb-2 w-full"></ul>
        <div class="border-b-2 border-dashed border-gray-400 mb-2"></div>
        <div class="flex justify-between font-bold text-lg">
            <span>Total:</span>
            <span>Rp <span id="struk-total">0</span></span>
        </div>
    </div>

    <script>
        // --- LOGIKA UNTUK TEMA (DARK/LIGHT MODE) ---
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const themeText = document.getElementById('theme-text');

        // Fungsi mengatur teks dan ikon tombol
        function updateToggleButton(isDark) {
            if (isDark) {
                themeIcon.innerText = '☀️';
                themeText.innerText = 'Mode Terang';
            } else {
                themeIcon.innerText = '🌙';
                themeText.innerText = 'Mode Gelap';
            }
        }

        // Cek posisi awal (dari localStorage atau sistem)
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            updateToggleButton(true);
        } else {
            document.documentElement.classList.remove('dark');
            updateToggleButton(false);
        }

        // Aksi pas tombol dipencet
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


        // --- LOGIKA MESIN KASIR ---
        let keranjang = [];
        let total = 0;

        function tambahKeKeranjang(id, nama, harga) {
            keranjang.push({ id, nama, harga });
            total += harga;
            updateLayarKeranjang();
        }

        function updateLayarKeranjang() {
            const listKeranjang = document.getElementById("list-keranjang");
            const strukKeranjang = document.getElementById("struk-keranjang");
            
            listKeranjang.innerHTML = "";
            strukKeranjang.innerHTML = "";

            keranjang.forEach((item) => {
                listKeranjang.innerHTML += `
                    <li class="flex justify-between border-b border-gray-100 dark:border-gray-700 pb-1">
                        <span>${item.nama}</span>
                        <span class="font-semibold">Rp ${item.harga.toLocaleString('id-ID')}</span>
                    </li>`;
                strukKeranjang.innerHTML += `
                    <li class="flex justify-between w-full">
                        <span>${item.nama}</span>
                        <span>Rp ${item.harga.toLocaleString('id-ID')}</span>
                    </li>`;
            });

            document.getElementById("total-harga").innerText = total.toLocaleString('id-ID');
            document.getElementById("struk-total").innerText = total.toLocaleString('id-ID');
            document.getElementById("modal-total").innerText = total.toLocaleString('id-ID');
        }

        function tampilkanQRIS() {
            if (keranjang.length === 0) {
                alert("Keranjang masih kosong, bosku!");
                return;
            }
            document.getElementById("qris-modal").classList.remove("hidden");
        }

        function tutupQRIS() {
            document.getElementById("qris-modal").classList.add("hidden");
        }

        function resetKeranjang() {
            keranjang = [];
            total = 0;
            updateLayarKeranjang();
        }

        function cetakStruk() {
            if (keranjang.length === 0) {
                alert("Belum ada barang yang bisa dicetak!");
                return;
            }
            window.print();
        }

        function konfirmasiBayar() {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            event.target.innerText = "Memproses...";
            event.target.disabled = true;

            fetch('{{ route('checkout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    keranjang: keranjang,
                    total: total
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Mantap! ' + data.message);
                    window.location.reload(); 
                } else {
                    alert('Gagal bosku: ' + data.message);
                    event.target.innerText = "Konfirmasi Lunas & Simpan";
                    event.target.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan jaringan.');
                event.target.innerText = "Konfirmasi Lunas & Simpan";
                event.target.disabled = false;
            });
        }
    </script>
</x-app-layout>