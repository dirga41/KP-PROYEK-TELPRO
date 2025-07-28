<!-- Modal Edit RKAP -->
<div id="rkapEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Edit Data RKAP</h3><button id="closeRkapEditModal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg></button>
        </div>
        <form id="rkapEditForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-3">
                {{-- [MODIFIKASI] Menambahkan variabel tahun dinamis untuk label --}}
                @php
                $currentYear = date('Y');
                $previousYear = $currentYear - 1;
                @endphp
                <div>
                    {{-- Field Bulan & Periode akan dibuat readonly oleh JavaScript --}}
                    <label for="edit_rkap_bulan" class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                    <input type="text" name="bulan" id="edit_rkap_bulan" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" readonly>
                </div>
                <div>
                    <label for="edit_rkap_periode" class="block mb-2 text-sm font-medium text-gray-900">Periode</label>
                    <input type="text" name="periode" id="edit_rkap_periode" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" readonly>
                </div>
                <div><label for="edit_rkap_value" class="block mb-2 text-sm font-medium text-gray-900">Nilai RKAP</label><input type="number" step="0.01" name="rkap_value" id="edit_rkap_value" placeholder="Rp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" required></div>
                <div><label for="edit_project_2025_value" class="block mb-2 text-sm font-medium text-gray-900">Nilai PROJECT {{ $currentYear }}</label><input type="number" step="0.01" name="project_2025_value" id="edit_project_2025_value" placeholder="Rp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" required></div>
                <div><label for="edit_rev_co_project_2024_sap_value" class="block mb-2 text-sm font-medium text-gray-900">Nilai REV CO PROJECT {{ $previousYear }} SAP</label><input type="number" step="0.01" name="rev_co_project_2024_sap_value" id="edit_rev_co_project_2024_sap_value" placeholder="Rp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" required></div>
                <div><label for="edit_project_2025_co_value" class="block mb-2 text-sm font-medium text-gray-900">Nilai PROJECT {{ $currentYear }} + CO</label><input type="number" step="0.01" name="project_2025_co_value" id="edit_project_2025_co_value" placeholder="Rp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5" required></div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end"><button id="cancelRkapEditModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button><button type="submit" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button></div>
        </form>
    </div>
</div>

<div id="rkapDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="p-6 text-center">
            <svg class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{-- [MODIFIKASI] Mengubah teks konfirmasi untuk aksi reset --}}
            <h3 id="deleteConfirmationText" class="mb-5 text-lg font-normal text-gray-500">Apakah Anda yakin ingin mereset data ini? Semua nilai akan diatur ke nol.</h3>
            <form id="rkapDeleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Ya, Reset</button>
                <button id="cancelRkapDeleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
            </form>
        </div>
    </div>
</div>