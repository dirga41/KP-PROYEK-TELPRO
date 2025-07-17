<div id="overview-content" data-tab-content="overview" class="tab-content hidden">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h4 class="text-gray-500 font-semibold text-sm">Luas Tanah</h4>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ number_format($totalLandArea, 0, ',', '.') }} m²</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h4 class="text-gray-500 font-semibold text-sm">Jumlah Gedung</h4>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $totalBuildings }} Gedung</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h4 class="text-gray-500 font-semibold text-sm">Asset NPA</h4>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $assetNPA }} Idle</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Daftar Aset</h3>
        <div class="max-h-80 overflow-y-auto">
             <table class="min-w-full">
                <thead>
                    <tr class="bg-red-500 text-white text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Nama Aset</th>
                        <th class="py-3 px-6 text-right">Luas Tanah (m²)</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse ($assets as $asset)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6 text-left font-medium">{{ $asset->nama_aset }}</td>
                        <td class="py-3 px-6 text-right">{{ number_format($asset->luas_tanah, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center py-4">Data Aset tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>