<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2">
                    Laporan Penjualan
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">No. Invoice</th>
                                <th class="p-3">Rincian Barang</th>
                                <th class="p-3">Total Belanja</th>
                                <th class="p-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-300">
                            @forelse($transactions as $trx)
                            <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                                <td class="p-3">{{ $trx->created_at->format('d M Y, H:i') }}</td>
                                <td class="p-3 font-bold text-blue-600 dark:text-blue-400">{{ $trx->invoice_number }}</td>
                                <td class="p-3">
                                    <ul class="list-disc pl-5 text-sm">
                                        @foreach($trx->details as $detail)
                                            <li>
                                                {{ $detail->product ? $detail->product->nama_barang : 'Barang Dihapus' }} 
                                                (Rp {{ number_format($detail->subtotal, 0, ',', '.') }})
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="p-3 font-semibold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                <td class="p-3 text-center">
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold uppercase">
                                        {{ $trx->status_pembayaran }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada transaksi lek.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>