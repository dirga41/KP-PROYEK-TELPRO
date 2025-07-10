<!-- Modal Input Kontrak -->
<div id="contractInputModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-5 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Input Data Kontrak</h3>
            <button id="closeContractInputModal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <form action="{{ route('contracts.store') }}" method="POST">
            @csrf

            {{-- PERUBAHAN: Menambahkan blok untuk menampilkan semua error validasi --}}
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
                    <p class="font-bold">Terjadi beberapa kesalahan:</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label for="tenant_name" class="block mb-2 text-sm font-medium text-gray-900">Nama Tenant</label><input type="text" name="tenant_name" id="tenant_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('tenant_name') }}"></div>
                <div><label for="tenant_group" class="block mb-2 text-sm font-medium text-gray-900">Grup Tenant</label><input type="text" name="tenant_group" id="tenant_group" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('tenant_group') }}"></div>
                <div><label for="area" class="block mb-2 text-sm font-medium text-gray-900">Area</label><input type="text" name="area" id="area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('area') }}"></div>
                
                {{-- PERUBAHAN: Mengubah input text menjadi dropdown untuk Segment --}}
                <div>
                    <label for="segment" class="block mb-2 text-sm font-medium text-gray-900">Segment</label>
                    <select name="segment" id="segment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="" disabled @if(!old('segment')) selected @endif>Pilih Segment</option>
                        <option value="Telkom" @if(old('segment') == 'Telkom') selected @endif>Telkom</option>
                        <option value="Enterprise" @if(old('segment') == 'Enterprise') selected @endif>Enterprise</option>
                        <option value="Subs & Afiliasi" @if(old('segment') == 'Subs & Afiliasi') selected @endif>Subs & Afiliasi</option>
                        <option value="Government" @if(old('segment') == 'Government') selected @endif>Government</option>
                    </select>
                </div>

                <div><label for="portfolio" class="block mb-2 text-sm font-medium text-gray-900">Portfolio</label><input type="text" name="portfolio" id="portfolio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('portfolio') }}"></div>
                <div><label for="tahun_kontrak" class="block mb-2 text-sm font-medium text-gray-900">Tahun Kontrak</label><input type="number" name="tahun_kontrak" id="tahun_kontrak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="YYYY" value="{{ old('tahun_kontrak') }}"></div>
                <div><label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Awal</label><input type="date" name="start_date" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('start_date') }}"></div>
                <div><label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Akhir</label><input type="date" name="end_date" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required value="{{ old('end_date') }}"></div>
                
                <div>
                    <label for="nilai_kontrak" class="block mb-2 text-sm font-medium text-gray-900">Nilai Kontrak (Rp)</label>
                    <input type="number" name="nilai_kontrak" id="nilai_kontrak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="Contoh: 50000000" value="{{ old('nilai_kontrak', 0) }}">
                </div>

                <div class="md:col-span-2"><label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status Kontrak</label><select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required><option value="aktif" @if(old('status') == 'aktif') selected @endif>Aktif</option><option value="akan berakhir" @if(old('status') == 'akan berakhir') selected @endif>Akan Berakhir</option><option value="berakhir" @if(old('status') == 'berakhir') selected @endif>Berakhir</option></select></div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end"><button id="cancelContractInputModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button><button type="submit" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button></div>
        </form>
    </div>
</div>

<!-- Modal Edit Kontrak -->
<div id="contractEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-5 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Edit Data Kontrak</h3><button id="closeContractEditModal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
        </div>
        <form id="contractEditForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label for="edit_tenant_name" class="block mb-2 text-sm font-medium text-gray-900">Nama Tenant</label><input type="text" name="tenant_name" id="edit_tenant_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></div>
                <div><label for="edit_tenant_group" class="block mb-2 text-sm font-medium text-gray-900">Grup Tenant</label><input type="text" name="tenant_group" id="edit_tenant_group" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                <div><label for="edit_area" class="block mb-2 text-sm font-medium text-gray-900">Area</label><input type="text" name="area" id="edit_area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></div>
                
                {{-- PERUBAHAN: Mengubah input text menjadi dropdown untuk Segment --}}
                <div>
                    <label for="edit_segment" class="block mb-2 text-sm font-medium text-gray-900">Segment</label>
                    <select name="segment" id="edit_segment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="Telkom">Telkom</option>
                        <option value="Enterprise">Enterprise</option>
                        <option value="Subs & Afiliasi">Subs & Afiliasi</option>
                        <option value="Government">Government</option>
                    </select>
                </div>
                
                <div><label for="edit_portfolio" class="block mb-2 text-sm font-medium text-gray-900">Portfolio</label><input type="text" name="portfolio" id="edit_portfolio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></div>
                <div><label for="edit_tahun_kontrak" class="block mb-2 text-sm font-medium text-gray-900">Tahun Kontrak</label><input type="number" name="tahun_kontrak" id="edit_tahun_kontrak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="YYYY"></div>
                <div><label for="edit_start_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Awal</label><input type="date" name="start_date" id="edit_start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></div>
                <div><label for="edit_end_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Akhir</label><input type="date" name="end_date" id="edit_end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></div>
                <div><label for="edit_nilai_kontrak" class="block mb-2 text-sm font-medium text-gray-900">Nilai Kontrak (Rp)</label><input type="number" name="nilai_kontrak" id="edit_nilai_kontrak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></div>
                <div class="md:col-span-2"><label for="edit_status" class="block mb-2 text-sm font-medium text-gray-900">Status Kontrak</label><select name="status" id="edit_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required><option value="aktif">Aktif</option><option value="akan berakhir">Akan Berakhir</option><option value="berakhir">Berakhir</option></select></div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end"><button id="cancelContractEditModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button><button type="submit" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button></div>
        </form>
    </div>
</div>


<!-- Modal Delete Kontrak (Tidak diubah) -->
<div id="contractDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="p-6 text-center">
            <svg class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda yakin ingin menghapus data kontrak ini?</h3>
            <form id="contractDeleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Ya, Hapus</button>
                <button id="cancelContractDeleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
            </form>
        </div>
    </div>
</div>
