<!-- Content Panel: Database Contract -->
<div id="contract-content" data-tab-content="contract" class="tab-content hidden">
    <!-- Tombol Aksi dan Pencarian -->
    <div class="flex justify-between items-center mb-4">
        <!-- Tombol Aksi Kiri (Export) -->
        <div>
            <button id="exportSelectedBtn"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center disabled:bg-gray-400 disabled:cursor-not-allowed"
                disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export Selected
            </button>
        </div>

        <!-- Tombol Aksi Kanan dan Pencarian -->
        <div class="flex items-center">
            <div class="relative">
                <input id="contractTableSearch" type="text" placeholder="Search..."
                    class="border rounded-lg py-2 px-8 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <span class="absolute left-2 top-2.5 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
            </div>
            <button id="openContractInputModal"
                class="ml-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">Input</button>
        </div>
    </div>

    @if (session('success_contract'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success_contract') }}</span>
    </div>
    @endif
    @if (session('error_contract'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error_contract') }}</span>
    </div>
    @endif

    <!-- Tabel Kontrak -->
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left"><input type="checkbox" id="selectAllContractsCheckbox"></th>
                    <th class="py-3 px-6 text-left">Tenant</th>
                    <th class="py-3 px-6 text-left">Area</th>
                    <th class="py-3 px-6 text-left">Segment</th>
                    <th class="py-3 px-6 text-left">Portfolio</th>
                    <th class="py-3 px-6 text-center">Tahun Kontrak</th>
                    <th class="py-3 px-6 text-center">Awal</th>
                    <th class="py-3 px-6 text-center">Akhir</th>
                    <th class="py-3 px-6 text-center">Status Kontrak</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="contractTableBody" class="text-gray-700 text-sm">
                @forelse ($contracts as $contract)
                <tr class="contract-row border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left"><input type="checkbox" class="contract-row-checkbox" data-id="{{ $contract->id }}"></td>
                    <td class="py-3 px-6 text-left">
                        <div class="font-medium">{{ $contract->tenant_name }}</div>
                        <div class="text-gray-500 text-xs">{{ $contract->tenant_group }}</div>
                    </td>
                    <td class="py-3 px-6 text-left">{{ $contract->area }}</td>
                    <td class="py-3 px-6 text-left">{{ $contract->segment }}</td>
                    <td class="py-3 px-6 text-left">{{ $contract->portfolio }}</td>
                    <td class="py-3 px-6 text-center">{{ $contract->tahun_kontrak }}</td>
                    <td class="py-3 px-6 text-center">{{ $contract->start_date->format('d-m-Y') }}</td>
                    <td class="py-3 px-6 text-center">{{ $contract->end_date->format('d-m-Y') }}</td>
                    <td class="py-3 px-6 text-center">
                        @if ($contract->status == 'aktif')
                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Aktif</span>
                        @elseif($contract->status == 'akan berakhir')
                            <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Akan Berakhir</span>
                        @else
                            <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">Berakhir</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <button data-id="{{ $contract->id }}" class="edit-contract-btn w-8 h-8 rounded-full flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-white mr-2" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536l12.232-12.232z" /></svg>
                            </button>
                            <button data-id="{{ $contract->id }}" class="delete-contract-btn w-8 h-8 rounded-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-6">Belum ada data kontrak.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>