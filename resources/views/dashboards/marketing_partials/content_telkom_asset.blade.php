<div id="aset_telkom-content" data-tab-content="aset_telkom" class="tab-content hidden">
    <div class="flex justify-between items-center mb-4">
        <div>
            <button id="exportSelectedAssetBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center disabled:bg-gray-400" disabled>
                Export Selected
            </button>
        </div>
        <div class="flex items-center">
            <button id="openAssetInputModal" class="mr-4 rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold py-2 px-4 rounded-lg">Input</button>
            <input id="assetTableSearch" type="text" placeholder="Search..." class="border rounded-lg py-2 px-4">
        </div>
    </div>

    @if (session('success_asset'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <span>{{ session('success_asset') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <th class="py-3 px-6 text-left"><input type="checkbox" id="selectAllAssetsCheckbox"></th>
                    <th class="py-3 px-6 text-left">Area</th>
                    <th class="py-3 px-6 text-left">Nama Aset</th>
                    <th class="py-3 px-6 text-left">Kota</th>
                    <th class="py-3 px-6 text-right">Luas Tanah (m²)</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="assetTableBody" class="text-gray-700 text-sm">
                @forelse ($assets as $asset)
                <tr class="asset-row border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6"><input type="checkbox" class="asset-row-checkbox" data-id="{{ $asset->id }}"></td>
                    <td class="py-3 px-6">{{ $asset->area }}</td>
                    <td class="py-3 px-6 font-medium">{{ $asset->nama_aset }}</td>
                    <td class="py-3 px-6">{{ $asset->kota }}</td>
                    <td class="py-3 px-6 text-right">{{ number_format($asset->luas_tanah, 0, ',', '.') }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <button data-id="{{ $asset->id }}" class="edit-asset-btn w-8 h-8 rounded-full flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-white mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536l12.232-12.232z" />
                                </svg>
                            </button>
                            <button data-id="{{ $asset->id }}" class="delete-asset-btn w-8 h-8 rounded-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>

                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6">Belum ada data aset.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>