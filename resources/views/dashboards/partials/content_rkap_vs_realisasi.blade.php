<div id="rkap-content" data-tab-content="rkap" class="tab-content hidden">
    <div class="flex justify-end items-center mb-4">
        <div class="relative">
            <input id="rkapTableSearch" type="text" placeholder="Search" class="border rounded-lg py-2 px-8">
            <span class="absolute left-2 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
        </div>
        <button id="openRkapInputModal" class="ml-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">Input</button>
    </div>
    
    @if (session('success_rkap'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success_rkap') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left"><input type="checkbox" id="selectAllRkapCheckbox"></th>
                    <th class="py-3 px-6 text-left">Bulan</th>
                    <th class="py-3 px-6 text-left">Periode</th>
                    <th class="py-3 px-6 text-left">RKAP</th>
                    <th class="py-3 px-6 text-left">PROJECT 2025</th>
                    <th class="py-3 px-6 text-left">REV CO PROJECT 2024 SAP</th>
                    <th class="py-3 px-6 text-left">PROJECT 2025 + CO PROJECT 2025</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="rkapTableBody" class="text-gray-700 text-sm">
                @forelse ($rkaps as $rkap)
                    <tr class="rkap-row border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 text-left"><input type="checkbox" class="rkap-row-checkbox" data-id="{{ $rkap->id }}"></td>
                        <td class="py-3 px-6 text-left font-medium">{{ $rkap->bulan }}</td>
                        <td class="py-3 px-6 text-left">{{ $rkap->periode }}</td>
                        <td class="py-3 px-6 text-left">Rp {{ number_format($rkap->rkap_value, 2, ',', '.') }}</td>
                        <td class="py-3 px-6 text-left">Rp {{ number_format($rkap->project_2025_value, 2, ',', '.') }}</td>
                        <td class="py-3 px-6 text-left">Rp {{ number_format($rkap->rev_co_project_2024_sap_value, 2, ',', '.') }}</td>
                        <td class="py-3 px-6 text-left">Rp {{ number_format($rkap->project_2025_co_value, 2, ',', '.') }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <button data-id="{{ $rkap->id }}" class="edit-rkap-btn w-8 h-8 rounded-full flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-white mr-2" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536l12.232-12.232z" /></svg>
                                </button>
                                <button data-id="{{ $rkap->id }}" class="delete-rkap-btn w-8 h-8 rounded-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6">Belum ada data RKAP vs Realisasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
