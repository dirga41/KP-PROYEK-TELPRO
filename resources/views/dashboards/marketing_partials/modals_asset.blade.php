<div id="assetInputModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-5 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
        <h3 class="text-xl font-semibold">Input Data Aset</h3>
        <form action="{{ route('assets.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            <div><label>Area</label><input type="text" name="area" class="w-full p-2 border rounded" required></div>
            <div><label>Nama Aset</label><input type="text" name="nama_aset" class="w-full p-2 border rounded" required></div>
            <div><label>Kota</label><input type="text" name="kota" class="w-full p-2 border rounded" required></div>
            <div><label>Luas Tanah (m²)</label><input type="number" name="luas_tanah" class="w-full p-2 border rounded" required></div>
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" id="cancelAssetInputModal" class="px-4 py-2 bg-gray-200 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="assetEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
     <div class="relative top-5 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
        <h3 class="text-xl font-semibold">Edit Data Aset</h3>
        <form id="assetEditForm" action="" method="POST" class="mt-4 space-y-4">
            @csrf
            @method('PUT')
            <div><label>Area</label><input type="text" name="area" id="edit_area" class="w-full p-2 border rounded" required></div>
            <div><label>Nama Aset</label><input type="text" name="nama_aset" id="edit_nama_aset" class="w-full p-2 border rounded" required></div>
            <div><label>Kota</label><input type="text" name="kota" id="edit_kota" class="w-full p-2 border rounded" required></div>
            <div><label>Luas Tanah (m²)</label><input type="number" name="luas_tanah" id="edit_luas_tanah" class="w-full p-2 border rounded" required></div>
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" id="cancelAssetEditModal" class="px-4 py-2 bg-gray-200 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<div id="assetDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h3 class="text-lg font-normal text-gray-600 mb-4">Anda yakin ingin menghapus data aset ini?</h3>
        <form id="assetDeleteForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" id="cancelAssetDeleteModal" class="px-5 py-2 mr-2 bg-gray-200 rounded">Batal</button>
            <button type="submit" class="px-5 py-2 bg-red-600 text-white rounded">Ya, Hapus</button>
        </form>
    </div>
</div>