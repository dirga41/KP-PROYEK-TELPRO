<div id="aset_gsd-content" data-tab-content="aset_gsd" class="tab-content hidden">
    {{-- Menambahkan Kontrol Atas (Tombol & Pencarian) --}}
    <div class="flex justify-between items-center mb-4">
        <div>
            {{-- Tombol Export, perlu ID unik --}}
            <button id="exportSelectedGsdAssetBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center disabled:bg-gray-400" disabled>
                Export Selected
            </button>
        </div>
        <div class="flex items-center">
            {{-- Tombol Input, perlu ID unik untuk membuka modal GSD --}}
            <button id="openGsdAssetInputModal" class="mr-4 rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold py-2 px-4 rounded-lg">Input</button>
            {{-- Input Pencarian, perlu ID unik --}}
            <input id="gsdAssetTableSearch" type="text" placeholder="Search..." class="border rounded-lg py-2 px-4">
        </div>
    </div>

    {{-- Notifikasi Sukses, menggunakan session key yang berbeda --}}
    @if (session('success_gsd_asset'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <span>{{ session('success_gsd_asset') }}</span>
    </div>
    @endif

    {{-- Tabel Data Aset GSD --}}
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                {{-- Header disesuaikan dengan gambar --}}
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <th class="py-3 px-6 text-left"><input type="checkbox" id="selectAllGsdAssetsCheckbox"></th>
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama Gedung</th>
                    <th class="py-3 px-6 text-left">Alamat Gedung</th>
                    <th class="py-3 px-6 text-left">Lantai Gedung</th>
                    <th class="py-3 px-6 text-right">Luasan Tersedia (m²)</th>
                    <th colspan="2" class="py-3 px-6 text-center">Luasan Terpakai</th>
                    <th class="py-3 px-6 text-right">Luasan Idle (m²)</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    {{-- Sub-header untuk Luasan Terpakai --}}
                    <th colspan="6"></th> {{-- Kolom kosong untuk alignment --}}
                    <th class="py-3 px-6 text-left">Customer</th>
                    <th class="py-3 px-6 text-right">Luas (m²)</th>
                    <th colspan="2"></th> {{-- Kolom kosong untuk alignment --}}
                </tr>
            </thead>
            {{-- Body tabel, perlu ID unik --}}
            <tbody id="gsdAssetTableBody" class="text-gray-700 text-sm">
                {{-- Loop data dari controller. Gunakan variabel baru, misal $gsd_assets --}}
                @forelse ($gsd_assets ?? [] as $index => $asset)
                {{-- Menambahkan class-row yang unik --}}
                <tr class="gsd-asset-row border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6"><input type="checkbox" class="gsd-asset-row-checkbox" data-id="{{ $asset->id }}"></td>
                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                    <td class="py-3 px-6 font-medium">{{ $asset->nama_gedung }}</td>
                    <td class="py-3 px-6">{{ $asset->alamat_gedung }}</td>
                    <td class="py-3 px-6">{{ $asset->lantai_gedung }}</td>
                    <td class="py-3 px-6 text-right">{{ number_format($asset->luasan_tersedia, 0, ',', '.') }}</td>
                    <td class="py-3 px-6">{{ $asset->customer ?? '-' }}</td>
                    <td class="py-3 px-6 text-right">{{ number_format($asset->luasan_terpakai, 0, ',', '.') }}</td>
                    <td class="py-3 px-6 text-right">{{ number_format($asset->luasan_idle, 0, ',', '.') }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            {{-- Tombol Edit & Delete dengan class unik --}}
                            <button data-id="{{ $asset->id }}" class="edit-gsd-asset-btn w-8 h-8 rounded-full flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-white mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536l12.232-12.232z" />
                                </svg>
                            </button>
                            <button data-id="{{ $asset->id }}" class="delete-gsd-asset-btn w-8 h-8 rounded-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-6">Belum ada data aset GSD.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>