<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .tab-active {
            border-bottom: 2px solid #DC2626;
            color: #1F2937;
        }

        .tab-inactive {
            border-bottom: 2px solid transparent;
            color: #6B7280;
        }
    </style>
</head>

<body class="bg-gray-50">

            </header>

            <!-- Content Area -->
            <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
                <div id="overview-content" data-tab-content="overview" class="tab-content">
                    <p class="text-gray-600">Konten untuk tab "Overview" akan ditampilkan di sini.</p>
                </div>
                <div id="on-hand-content" data-tab-content="on-hand" class="tab-content hidden">
                    <div class="flex justify-end items-center mb-4">
                        <div class="relative"><input id="projectTableSearch" type="text" placeholder="Search"
                                class="border rounded-lg py-2 px-8"><span
                                class="absolute left-2 top-2.5 text-gray-400"><svg class="w-5 h-5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg></span></div>
                        <button id="openInputModal"
                            class="ml-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">Input</button>
                    </div>
                    @if (session('success'))

                    @endif
                    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left"><input type="checkbox" id="selectAllCheckbox">
                                    </th>
                                    <th class="py-3 px-6 text-left">Segment</th>
                                    <th class="py-3 px-6 text-left">Area</th>
                                    <th class="py-3 px-6 text-left">Project</th>
                                    <th class="py-3 px-6 text-left">No Kontrak</th>
                                    <th class="py-3 px-6 text-left">Tgl Kontrak</th>
                                    <th class="py-3 px-6 text-left">Nilai</th>
                                    <th class="py-3 px-6 text-left">TOC</th>
                                    <th class="py-3 px-6 text-center">Status Progress</th>
                                    <th class="py-3 px-6 text-center">Actions</th>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="planning-content" data-tab-content="planning" class="tab-content hidden">
                    <p class="text-gray-600">Konten untuk tab "Project Planning" akan ditampilkan di sini.</p>
                </div>
            </div>
        </main>
    </div>

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
                            <option value="Semarang jateng utara">Semarang jateng utara</option>
                            <option value="Yogya jateng selatan">Yogya jateng selatan</option>
                            <option value="Solo jateng timur">Solo jateng timur</option>
                            <option value="Jatim Barat">Jatim Barat</option>
                            <option value="Suramadu">Suramadu</option>
                            <option value="Jatim timur">Jatim timur</option>
                            <option value="Bali">Bali</option>
                            <option value="Nusra">Nusra</option>
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

    <!-- Modal Edit Project -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
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
                <div class="space-y-4">
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

    <!-- Modal View Project -->
    <div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center border-b pb-3 mb-5">
                <h3 class="text-xl font-semibold text-gray-900">Detail Proyek</h3><button id="closeViewModal"
                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"><svg
                        class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg></button>
            </div>
            <div id="viewModalContent" class="space-y-4"></div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b justify-end"><button
                    id="cancelViewModal" type="button"
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            // --- FUNGSI SEARCH SIDEBAR ---
            const sidebarSearchInput = document.getElementById('sidebarSearchInput');
            if (sidebarSearchInput) {
                const navItems = document.querySelectorAll('#mainNav .nav-item');
                sidebarSearchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    navItems.forEach(item => {
                        const itemText = item.textContent.toLowerCase();
                        if (itemText.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }

            // --- FUNGSI SEARCH TABEL ---
            const projectTableSearch = document.getElementById('projectTableSearch');
            if (projectTableSearch) {
                const projectTableBody = document.getElementById('projectTableBody');
                const projectRows = projectTableBody.getElementsByClassName('project-row');
                projectTableSearch.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    for (let row of projectRows) {
                        const rowText = row.textContent.toLowerCase();
                        if (rowText.includes(searchTerm)) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            }

            // --- FUNGSI TABS ---
            const tabs = document.querySelectorAll('#tabs .tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            function showTab(tabId) {
                const targetTab = document.querySelector(`[data-tab="${tabId}"]`);
                const targetContent = document.querySelector(`[data-tab-content="${tabId}"]`);

                if (targetTab && targetContent) {
                    tabs.forEach(item => {
                        item.classList.remove('tab-active');
                        item.classList.add('tab-inactive');
                    });
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    targetTab.classList.remove('tab-inactive');
                    targetTab.classList.add('tab-active');
                    targetContent.classList.remove('hidden');
                }
            }

            // Event listener untuk klik tab
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tabId = this.dataset.tab;
                    showTab(tabId);
                    // Update URL hash untuk navigasi yang lebih baik
                    window.location.hash = tabId;
                });
            });

            // Periksa URL hash saat halaman dimuat untuk membuka tab yang benar
            if (window.location.hash) {
                const hash = window.location.hash.substring(1); // Hapus tanda #
                showTab(hash);
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    tabs.forEach(item => {
                        item.classList.remove('tab-active');
                        item.classList.add('tab-inactive');
                    });
                    this.classList.remove('tab-inactive');
                    this.classList.add('tab-active');
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    const targetContent = document.querySelector(
                        `[data-tab-content="${this.dataset.tab}"]`);
                    if (targetContent) {
                        targetContent.classList.remove('hidden');
                    }
                });
            });

            // --- FUNGSI MODAL INPUT ---
            const inputModal = document.getElementById('inputModal');
            const openInputModalBtn = document.getElementById('openInputModal');
            const closeInputModalBtn = document.getElementById('closeInputModal');
            const cancelInputModalBtn = document.getElementById('cancelInputModal');
            if (openInputModalBtn) openInputModalBtn.addEventListener('click', () => inputModal.classList.remove(
                'hidden'));
            if (closeInputModalBtn) closeInputModalBtn.addEventListener('click', () => inputModal.classList.add(
                'hidden'));
            if (cancelInputModalBtn) cancelInputModalBtn.addEventListener('click', () => inputModal.classList.add(
                'hidden'));


            const editModal = document.getElementById('editModal');
            const closeEditModalBtn = document.getElementById('closeEditModal');
            const cancelEditModalBtn = document.getElementById('cancelEditModal');
            const editForm = document.getElementById('editForm');
            const editNilaiInput = document.getElementById('edit_nilai_kontrak');
            const editStatusSelect = document.getElementById('edit_status_progres');
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const projectId = this.dataset.id;
                    fetch(`/projects/${projectId}`)
                        .then(response => response.json())
                        .then(data => {
                            editForm.action = `/projects/${projectId}`;
                            editNilaiInput.value = parseFloat(data.nilai_kontrak);
                            editStatusSelect.value = data.status_progres;
                            editModal.classList.remove('hidden');
                        });
                });
            });
            if (closeEditModalBtn) closeEditModalBtn.addEventListener('click', () => editModal.classList.add(
                'hidden'));
            if (cancelEditModalBtn) cancelEditModalBtn.addEventListener('click', () => editModal.classList.add(
                'hidden'));

            // --- FUNGSI MODAL VIEW ---
            const viewModal = document.getElementById('viewModal');
            const closeViewModalBtn = document.getElementById('closeViewModal');
            const cancelViewModalBtn = document.getElementById('cancelViewModal');
            const viewModalContent = document.getElementById('viewModalContent');
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const projectId = this.dataset.id;
                    fetch(`/projects/${projectId}`)
                        .then(response => response.json())
                        .then(data => {
                            viewModalContent.innerHTML =
                                `<div class="grid grid-cols-2 gap-4"><p><strong class="font-semibold text-gray-600">Project:</strong><br>${data.project}</p><p><strong class="font-semibold text-gray-600">No Kontrak:</strong><br>${data.no_kontrak}</p><p><strong class="font-semibold text-gray-600">Segment:</strong><br>${data.segment}</p><p><strong class="font-semibold text-gray-600">Area:</strong><br>${data.area}</p><p><strong class="font-semibold text-gray-600">Tanggal Kontrak:</strong><br>${new Date(data.tanggal_kontrak).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</p><p><strong class="font-semibold text-gray-600">Nilai Kontrak:</strong><br>Rp ${new Intl.NumberFormat('id-ID').format(data.nilai_kontrak)}</p><p><strong class="font-semibold text-gray-600">Tanggal TOC:</strong><br>${data.toc ? new Date(data.toc).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-'}</p><p><strong class="font-semibold text-gray-600">Status:</strong><br>${data.status_progres}</p></div>`;
                            viewModal.classList.remove('hidden');
                        });
                });
            });
            if (closeViewModalBtn) closeViewModalBtn.addEventListener('click', () => viewModal.classList.add(
                'hidden'));
            if (cancelViewModalBtn) cancelViewModalBtn.addEventListener('click', () => viewModal.classList.add(
                'hidden'));

            // --- FUNGSI MODAL DELETE ---
            const deleteModal = document.getElementById('deleteModal');
            const cancelDeleteModalBtn = document.getElementById('cancelDeleteModal');
            const deleteForm = document.getElementById('deleteForm');
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Mencegah form di dalam tabel langsung submit
                    const projectId = this.dataset.id;
                    deleteForm.action = `/projects/${projectId}`;
                    deleteModal.classList.remove('hidden');
                });
            });
            if (cancelDeleteModalBtn) cancelDeleteModalBtn.addEventListener('click', () => deleteModal.classList
                .add('hidden'));
        });
    </script>

</body>


