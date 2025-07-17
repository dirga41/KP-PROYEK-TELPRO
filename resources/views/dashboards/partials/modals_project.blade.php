<!-- Modal Input Project -->
<div id="inputModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Input Project</h3>
            <button id="closeInputModal"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="segment" class="block mb-2 text-sm font-medium text-gray-900">Segment</label>
                    <select name="segment" id="segment"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="Telsa & Others">Telsa & Others</option>
                        <option value="Telkom">Telkom</option>
                    </select>
                </div>
                <div>
                    <label for="area" class="block mb-2 text-sm font-medium text-gray-900">Area</label>
                    <select name="area" id="area"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="Semarang jateng utara">Semarang Jateng Utara</option>
                        <option value="Yogya jateng selatan">Yogya Jateng Selatan</option>
                        <option value="Solo jateng timur">Solo Jateng Timur</option>
                        <option value="Jatim Barat">Jatim Barat</option>
                        <option value="Suramadu">Suramadu</option>
                        <option value="Jatim timur">Jatim Timur</option>
                        <option value="Bali">Bali</option>
                        <option value="Nusra">Nusa Tenggara</option>
                    </select>
                </div>
                <div><label for="project"
                        class="block mb-2 text-sm font-medium text-gray-900">Project</label><input type="text"
                        name="project" id="project"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required></div>
                <div><label for="no_kontrak" class="block mb-2 text-sm font-medium text-gray-900">No
                        Kontrak</label><input type="text" name="no_kontrak" id="no_kontrak"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required></div>
                <div><label for="tanggal_kontrak" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                        Kontrak</label><input type="date" name="tanggal_kontrak" id="tanggal_kontrak"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required></div>
                <div><label for="nilai_kontrak"
                        class="block mb-2 text-sm font-medium text-gray-900">Nilai</label><input type="number"
                        name="nilai_kontrak" id="nilai_kontrak" placeholder="Rp"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required></div>
                <div><label for="toc" class="block mb-2 text-sm font-medium text-gray-900">TOC</label><input
                        type="date" name="toc" id="toc"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div>
                    <label for="status_progres" class="block mb-2 text-sm font-medium text-gray-900">Status
                        Progress</label>
                    <select name="status_progres" id="status_progres"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="not started">Not Started</option>
                        <option value="ongoing">On Going</option>
                        <option value="closed">Closed</option>
                        <option value="closed adm">Closed Adm</option>
                    </select>
                </div>
                <div>
                    <label for="jenis_pengadaan" class="block mb-2 text-sm font-medium text-gray-900">Jenis Pengadaan</label>
                    <select name="jenis_pengadaan" id="jenis_pengadaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Jenis Pengadaan</option>
                        <option value="mitra">Mitra</option>
                        <option value="swakelola">Swakelola</option>
                    </select>
                </div>
                <div>
                    <label for="status_panjar" class="block mb-2 text-sm font-medium text-gray-900">Status Panjar</label>
                    <select name="status_panjar" id="status_panjar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Status Panjar</option>
                        <option value="belum drop">Belum Drop</option>
                        <option value="mitra">Mitra</option>
                        <option value="sudah drop">Sudah Drop</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end">
                <button id="cancelInputModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                <button type="submit"
                    class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Yes</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Edit Project</h3><button id="closeEditModal"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"><svg
                    class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg></button>
        </div>
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                <div><label for="edit_nilai_kontrak"
                        class="block mb-2 text-sm font-medium text-gray-900">Nilai</label><input type="number"
                        name="nilai_kontrak" id="edit_nilai_kontrak" placeholder="Rp"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required></div>
                <div><label for="edit_status_progres" class="block mb-2 text-sm font-medium text-gray-900">Status
                        Progress</label><select name="status_progres" id="edit_status_progres"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                        <option value="not started">Not Started</option>
                        <option value="ongoing">On Going</option>
                        <option value="closed">Closed</option>
                        <option value="closed adm">Closed Adm</option>
                    </select></div>
                <div>
                    <label for="edit_jenis_pengadaan" class="block mb-2 text-sm font-medium text-gray-900">Jenis Pengadaan</label>
                    <select name="jenis_pengadaan" id="edit_jenis_pengadaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Jenis Pengadaan</option>
                        <option value="mitra">Mitra</option>
                        <option value="swakelola">Swakelola</option>
                    </select>
                </div>
                <div>
                    <label for="edit_status_panjar" class="block mb-2 text-sm font-medium text-gray-900">Status Panjar</label>
                    <select name="status_panjar" id="edit_status_panjar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Status Panjar</option>
                        <option value="belum drop">Belum Drop</option>
                        <option value="mitra">Mitra</option>
                        <option value="sudah drop">Sudah Drop</option>
                    </select>
                </div>

                <div class="pt-4 mt-4 border-t">
                    <h4 class="text-md font-semibold text-gray-800 mb-2">Timeline Dates</h4>
                    <div><label for="edit_toc_date" class="block mb-2 text-sm font-medium text-gray-900">TOC Date</label><input type="date" name="toc" id="edit_toc_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                    <div><label for="edit_spk_date" class="block mb-2 text-sm font-medium text-gray-900">SPK Date</label><input type="date" name="spk_date" id="edit_spk_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                    <div><label for="edit_leads_date" class="block mb-2 text-sm font-medium text-gray-900">LEADS Date</label><input type="date" name="leads_date" id="edit_leads_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                    <div><label for="edit_approval_jib_date" class="block mb-2 text-sm font-medium text-gray-900">APPROVAL JIB Date</label><input type="date" name="approval_jib_date" id="edit_approval_jib_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                    <div><label for="edit_contract_date" class="block mb-2 text-sm font-medium text-gray-900">CONTRACT Date</label><input type="date" name="contract_date" id="edit_contract_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                    <div><label for="edit_procurement_juskeb_date" class="block mb-2 text-sm font-medium text-gray-900">PROCUREMENT - JUSKEB Date</label><input type="date" name="procurement_juskeb_date" id="edit_procurement_juskeb_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                    <div><label for="edit_procurement_rb_date" class="block mb-2 text-sm font-medium text-gray-900">PROCUREMENT - RB Date</label><input type="date" name="procurement_rb_date" id="edit_procurement_rb_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                    <div><label for="edit_procurement_jusrpeng_date" class="block mb-2 text-sm font-medium text-gray-900">PROCUREMENT - JUSPENG Date</label><input type="date" name="procurement_juspeng_date" id="edit_procurement_juspeng_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></div>
                </div>

            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end">
                <button id="cancelEditModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                <button type="submit"
                    class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
            </div>
        </form>
    </div>
</div>

<div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center border-b pb-3 mb-5">
            <h3 class="text-xl font-semibold text-gray-900">Detail Proyek</h3><button id="closeViewModal"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"><svg
                    class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg></button>
        </div>
        <div id="viewModalContent" class="space-y-4">
        </div>

        <div class="mt-6 pt-4 border-t">
            <h4 class="text-md font-semibold text-gray-800 mb-2">Timeline CRM</h4>
            <div style="height: 300px;">
                <canvas id="crmTimelineChart"></canvas>
            </div>
        </div>

        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end">
            <button id="cancelViewModal" type="button"
                class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-white focus:z-10">Close</button>
        </div>
    </div>
</div>

<!-- Modal Delete Confirmation -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="p-6 text-center">
            <svg class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah Anda yakin ingin menghapus proyek ini?</h3>
            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Ya,
                    Hapus</button>
                <button id="cancelDeleteModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
            </form>
        </div>
    </div>
</div>
