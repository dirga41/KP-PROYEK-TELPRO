<div id="overview-content" data-tab-content="overview" class="tab-content hidden">

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <img src="{{ asset('asset/Adobe Express - file (1).png') }}"
            alt="Peta wilayah Jawa dan Nusa Tenggara"
            class="block w-full h-auto rounded-lg mx-auto">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gradient-to-r from-[#FD8E01] to-[#B23902] p-6 rounded-lg shadow-md text-center">
            <h4 class="text-white font-semibold text-sm">Luas Tanah</h4>
            <p class="text-3xl font-bold text-white mt-2">{{ number_format($totalLandArea, 0, ',', '.') }} m²</p>
        </div>
        <div class="bg-gradient-to-r from-[#FD8E01] to-[#B23902] p-6 rounded-lg shadow-md text-center">
            <h4 class="text-white font-semibold text-sm">Jumlah Gedung</h4>
            <p class="text-3xl font-bold text-white mt-2">{{ $totalBuildings }} Gedung</p>
        </div>
        <div class="bg-gradient-to-r from-[#FD8E01] to-[#B23902] p-6 rounded-lg shadow-md text-center">
            <h4 class="text-white font-semibold text-sm">Asset NPA</h4>
            <p class="text-3xl font-bold text-white mt-2">{{ $assetNPA }} Idle</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Daftar Aset</h3>
        <div class="p-4 sm:p-6 md:p-8">
            <table class="min-w-full border-separate" style="border-spacing: 10px 0;">
                <thead class="text-white">
                    <tr>
                        <th class="py-3 px-4 sm:px-6 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902]">
                            No
                        </th>
                        <th class="py-3 px-4 sm:px-6 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902]">
                            Tenant
                        </th>
                        <th class="py-3 px-4 sm:px-6 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902]">
                            Nilai Kontrak
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="py-3 px-4 sm:px-6">1.</td>
                        <td class="py-3 px-4 sm:px-6">Telkom</td>
                        <td class="py-3 px-4 sm:px-6">Rp.</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="py-3 px-4 sm:px-6">2.</td>
                        <td class="py-3 px-4 sm:px-6">Non Telkom</td>
                        <td class="py-3 px-4 sm:px-6">Rp.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>