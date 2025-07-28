<div id="gsdAssetInputModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-5 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Input Data Aset GSD Baru</h3>
            <button id="closeGsdAssetInputModal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <form action="{{ route('gsd-assets.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    {{-- PERUBAHAN --}}
                    <label for="nama_gedung" class="block mb-2 text-sm font-medium text-gray-900">Nama Gedung</label>
                    <select name="nama_gedung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="" disabled selected>Pilih Gedung</option>
                        <option value="Gedung TLT">Gedung TLT</option>
                        <option value="Gedung Menur Sby">Gedung Menur Sby</option>
                        <option value="Gedung Kusuma Bangsa">Gedung Kusuma Bangsa</option>
                    </select>
                </div>
                {{-- Input lainnya tetap sama --}}
                 <div>
                    <label for="alamat_gedung" class="block mb-2 text-sm font-medium text-gray-900">Alamat Gedung</label>
                    <input type="text" name="alamat_gedung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="lantai_gedung" class="block mb-2 text-sm font-medium text-gray-900">Lantai Gedung</label>
                    <input type="text" name="lantai_gedung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="luasan_tersedia" class="block mb-2 text-sm font-medium text-gray-900">Luasan Tersedia (m²)</label>
                    <input type="number" step="0.01" name="luasan_tersedia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="customer" class="block mb-2 text-sm font-medium text-gray-900">Customer</label>
                    <input type="text" name="customer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="luasan_terpakai" class="block mb-2 text-sm font-medium text-gray-900">Luasan Terpakai (m²)</label>
                    <input type="number" step="0.01" name="luasan_terpakai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                 <div>
                    <label for="luasan_idle" class="block mb-2 text-sm font-medium text-gray-900">Luasan Idle (m²)</label>
                    <input type="number" step="0.01" name="luasan_idle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end mt-6">
                <button type="button" id="cancelGsdAssetInputModal" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                <button type="submit" class="text-white bg-gradient-to-r from-[#FD8E01] to-[#B23902] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="gsdAssetEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-5 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Edit Data Aset GSD</h3>
            <button id="closeGsdAssetEditModal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <form id="gsdAssetEditForm" method="POST" class="mt-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    {{-- PERUBAHAN --}}
                    <label for="edit_gsd_nama_gedung" class="block mb-2 text-sm font-medium text-gray-900">Nama Gedung</label>
                    <select id="edit_gsd_nama_gedung" name="nama_gedung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                        <option value="Gedung TLT">Gedung TLT</option>
                        <option value="Gedung Menur Sby">Gedung Menur Sby</option>
                        <option value="Gedung Kusuma Bangsa">Gedung Kusuma Bangsa</option>
                    </select>
                </div>
                {{-- Input lainnya tetap sama --}}
                <div>
                    <label for="edit_gsd_alamat_gedung" class="block mb-2 text-sm font-medium text-gray-900">Alamat Gedung</label>
                    <input type="text" id="edit_gsd_alamat_gedung" name="alamat_gedung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="edit_gsd_lantai_gedung" class="block mb-2 text-sm font-medium text-gray-900">Lantai Gedung</label>
                    <input type="text" id="edit_gsd_lantai_gedung" name="lantai_gedung" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="edit_gsd_luasan_tersedia" class="block mb-2 text-sm font-medium text-gray-900">Luasan Tersedia (m²)</label>
                    <input type="number" step="0.01" id="edit_gsd_luasan_tersedia" name="luasan_tersedia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                </div>
                <div>
                    <label for="edit_gsd_customer" class="block mb-2 text-sm font-medium text-gray-900">Customer</label>
                    <input type="text" id="edit_gsd_customer" name="customer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="edit_gsd_luasan_terpakai" class="block mb-2 text-sm font-medium text-gray-900">Luasan Terpakai (m²)</label>
                    <input type="number" step="0.01" id="edit_gsd_luasan_terpakai" name="luasan_terpakai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                </div>
                 <div>
                    <label for="edit_gsd_luasan_idle" class="block mb-2 text-sm font-medium text-gray-900">Luasan Idle (m²)</label>
                    <input type="number" step="0.01" id="edit_gsd_luasan_idle" name="luasan_idle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end mt-6">
                <button type="button" id="cancelGsdAssetEditModal" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                <button type="submit" class="text-white bg-gradient-to-r from-[#FD8E01] to-[#B23902] focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
            </div>
        </form>
    </div>
</div>
{{-- Modal Delete tidak perlu diubah --}}
<div id="gsdAssetDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Hapus Data Aset</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            
            {{-- Form ini yang akan dieksekusi saat tombol "Ya, Hapus" diklik --}}
            <form id="gsdAssetDeleteForm" action="" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <div class="items-center px-4 py-3">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Ya, Hapus
                    </button>
                    <button type="button" id="cancelGsdAssetDeleteModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>