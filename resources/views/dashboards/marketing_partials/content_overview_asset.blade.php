<div id="overview-content" data-tab-content="overview" class="tab-content">

    {{-- Peta Wilayah --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <img src="{{ asset('asset/Adobe Express - file (1).png') }}"
            alt="Peta wilayah Jawa dan Nusa Tenggara"
            class="block w-full h-auto rounded-lg mx-auto">
    </div>

    {{-- Grid untuk 3 kartu statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        {{-- Card 1: Luas Tanah --}}
        <div class="bg-gradient-to-r from-[#FD8E01] to-[#B23902] p-6 rounded-lg shadow-md flex flex-col justify-center text-center h-full">
            <h4 class="text-white/80 font-medium tracking-wider uppercase text-sm">Luas Tanah</h4>
            <p class="text-4xl font-bold text-white mt-2">{{ number_format($totalLandArea, 0, ',', '.') }} <span class="text-2xl font-medium">m²</span></p>
        </div>

        {{-- Card 2: Jumlah Gedung --}}
        <div class="bg-gradient-to-r from-[#FD8E01] to-[#B23902] p-6 rounded-lg shadow-md flex flex-col justify-center text-center h-full">
            <h4 class="text-white/80 font-medium tracking-wider uppercase text-sm">Jumlah Gedung</h4>
            <p class="text-4xl font-bold text-white mt-2">{{ $totalBuildings }} <span class="text-2xl font-medium">Gedung</span></p>
        </div>

        {{-- Card 3: Asset NPA (Menggunakan desain minimalis yang disempurnakan) --}}
        <div class="bg-gradient-to-r from-[#FD8E01] to-[#B23902] p-6 rounded-lg shadow-md text-white flex flex-col h-full">
            <div>
                <h4 class="font-medium text-white/80 tracking-wider uppercase">Asset NPA</h4>
            </div>
            <div class="mt-4 flex-grow flex flex-col justify-center">
                <div class="space-y-3">
                    {{-- PERUBAHAN --}}
                    <div>
                        <p class="font-semibold text-base">Rasio Gd TLT</p>
                        {{-- Menampilkan rasio yang dihitung dari controller --}}
                        <p class="text-2xl font-bold">{{ number_format($rasioGedungTlt ?? 0, 2, ',', '.') }} %</p>
                    </div>
                    <hr class="border-white/20">
                    <div>
                        <p class="font-semibold text-base">Rasio Gd Menur Sby</p>
                        {{-- Menampilkan rasio yang dihitung dari controller --}}
                        <p class="text-2xl font-bold">{{ number_format($rasioGedungMenurSby ?? 0, 2, ',', '.') }} %</p>
                    </div>
                    <hr class="border-white/20">
                    <div>
                        <p class="font-semibold text-base">Rasio Gd Kusuma Bangsa</p>
                        {{-- Menampilkan rasio yang dihitung dari controller --}}
                        <p class="text-2xl font-bold">{{ number_format($rasioGedungKusumaBangsa ?? 0, 2, ',', '.') }} %</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Daftar Aset --}}
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