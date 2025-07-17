<div id="asset-content">
    
    <div class="flex justify-end items-center mb-4">
        <div class="relative">
            <input id="assetTableSearch" type="text" placeholder="Search asset..."
                class="border rounded-lg py-2 px-8 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <span class="absolute left-2 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Tenant</th>
                    <th class="py-3 px-6 text-left">Area</th>
                    <th class="py-3 px-6 text-left">Segment</th>
                    <th class="py-3 px-6 text-left">Portfolio</th>
                    <th class="py-3 px-6 text-center">Tanggal Awal</th>
                    <th class="py-3 px-6 text-center">Tanggal Akhir</th>
                    <th class="py-3 px-6 text-center">Status Kontrak</th>
                </tr>
            </thead>
            <tbody id="assetTableBody" class="text-gray-700 text-sm">
                {{-- Data untuk tabel ini berasal dari variabel $contracts yang dikirim oleh method asset() di ContractController --}}
                @forelse ($contracts as $contract)
                <tr class="asset-row border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                    <td class="py-3 px-6 text-left">
                        <div class="font-medium">{{ $contract->tenant_name }}</div>
                        <div class="text-gray-500 text-xs">{{ $contract->tenant_group }}</div>
                    </td>
                    <td class="py-3 px-6 text-left">{{ $contract->area }}</td>
                    <td class="py-3 px-6 text-left">{{ $contract->segment }}</td>
                    <td class="py-3 px-6 text-left">{{ $contract->portfolio }}</td>
                    <td class="py-3 px-6 text-center">{{ $contract->start_date->format('d-m-Y') }}</td>
                    <td class="py-3 px-6 text-center">{{ $contract->end_date->format('d-m-Y') }}</td>
                    <td class="py-3 px-6 text-center">
                        {{-- Logika status ini diambil dari accessor di model Contract.php --}}
                        @if ($contract->status == 'aktif')
                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Aktif</span>
                        @elseif($contract->status == 'akan berakhir')
                            <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Akan Berakhir</span>
                        @else
                            <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">Berakhir</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-6">Belum ada data aset kontrak yang bisa ditampilkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>