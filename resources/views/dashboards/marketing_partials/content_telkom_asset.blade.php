<div id="aset_telkom-content" data-tab-content="aset_telkom" class="tab-content hidden">
    <div class="flex justify-between items-center mb-4">
        <div>
            <button id="exportSelectedAssetBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center disabled:bg-gray-400" disabled>
                Export Selected
            </button>
        </div>
        <div class="flex items-center">
            <input id="assetTableSearch" type="text" placeholder="Search..." class="border rounded-lg py-2 px-4">
            <button id="openAssetInputModal" class="ml-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Input</button>
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
                            <button data-id="{{ $asset->id }}" class="edit-asset-btn w-8 h-8 rounded-full flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-white mr-2">✏️</button>
                            <button data-id="{{ $asset->id }}" class="delete-asset-btn w-8 h-8 rounded-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white">🗑️</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-6">Belum ada data aset.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>