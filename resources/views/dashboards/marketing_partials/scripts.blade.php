<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        /**
         * Fungsi inisialisasi utama untuk dasbor marketing.
         */
        function init() {
            initTabs();
            initContractFeatures();
        }

        /**
         * Mengatur sistem navigasi tab.
         * Logika ini membaca URL hash saat halaman dimuat untuk memilih tab yang benar.
         */
        function initTabs() {
            const tabs = document.querySelectorAll('#tabs .tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            const showTab = (tabId) => {
                const targetTab = document.querySelector(`a.tab-link[data-tab="${tabId}"]`);
                const targetContent = document.querySelector(`div.tab-content[data-tab-content="${tabId}"]`);

                // Jika tab atau konten tidak ditemukan, kembali ke overview.
                if (!targetTab || !targetContent) {
                    if (tabId !== 'overview') {
                        showTab('overview');
                    }
                    return;
                }

                // Nonaktifkan semua tab dan sembunyikan semua konten terlebih dahulu.
                tabs.forEach(t => {
                    t.classList.remove('tab-active');
                    t.classList.add('tab-inactive');
                });
                tabContents.forEach(c => c.classList.add('hidden'));

                // Aktifkan tab target dan tampilkan kontennya.
                targetTab.classList.remove('tab-inactive');
                targetTab.classList.add('tab-active');
                targetContent.classList.remove('hidden');
            };

            // Tambahkan event listener untuk setiap klik pada tab.
            tabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();
                    const tabId = this.dataset.tab;
                    // Perbarui hash di URL tanpa me-reload halaman.
                    window.history.pushState(null, null, `#${tabId}`);
                    showTab(tabId);
                });
            });

            // --- LOGIKA KUNCI UNTUK MEMPERBAIKI MASALAH ---
            // Saat halaman dimuat, periksa apakah ada hash di URL.
            if (window.location.hash) {
                // Ambil ID tab dari hash (misal: dari "#contract" menjadi "contract").
                const tabIdFromHash = window.location.hash.substring(1);
                showTab(tabIdFromHash);
            } else {
                // Jika tidak ada hash, tampilkan tab "overview" sebagai default.
                showTab('overview');
            }
        }

        /**
         * Menginisialisasi semua fitur untuk tab "Database Contract".
         */
        function initContractFeatures() {
            setupTableSearch('contractTableSearch', '#contractTableBody .contract-row');
            setupSelectAll('selectAllContractsCheckbox', '.contract-row-checkbox');
            setupModals();
            setupExport(
                'exportSelectedBtn', 
                '.contract-row-checkbox', 
                "{{ route('contracts.export') }}",
                'kontrak'
            );
        }

        function setupModals() {
            const openInputModalBtn = document.getElementById('openContractInputModal');
            const inputModal = document.getElementById('contractInputModal');
            if (openInputModalBtn && inputModal) {
                openInputModalBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    inputModal.classList.remove('hidden');
                });
            }
            document.getElementById('closeContractInputModal')?.addEventListener('click', () => inputModal.classList.add('hidden'));
            document.getElementById('cancelContractInputModal')?.addEventListener('click', () => inputModal.classList.add('hidden'));

            const editModal = document.getElementById('contractEditModal');
            document.querySelectorAll('.edit-contract-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    handleContractEdit(e.currentTarget.dataset.id);
                });
            });
            document.getElementById('closeContractEditModal')?.addEventListener('click', () => editModal.classList.add('hidden'));
            document.getElementById('cancelContractEditModal')?.addEventListener('click', () => editModal.classList.add('hidden'));

            const deleteModal = document.getElementById('contractDeleteModal');
            document.querySelectorAll('.delete-contract-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    handleContractDelete(e.currentTarget.dataset.id);
                });
            });
            document.getElementById('cancelContractDeleteModal')?.addEventListener('click', () => deleteModal.classList.add('hidden'));
        }

        function setupTableSearch(inputId, rowSelector) {
            const searchInput = document.getElementById(inputId);
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const searchTerm = e.target.value.toLowerCase();
                    document.querySelectorAll(rowSelector).forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? 'table-row' : 'none';
                    });
                });
            }
        }

        function setupSelectAll(selectAllId, rowCheckboxSelector) {
            const selectAll = document.getElementById(selectAllId);
            const exportBtn = document.getElementById('exportSelectedBtn');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    const isChecked = this.checked;
                    document.querySelectorAll(rowCheckboxSelector).forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                    if(exportBtn) exportBtn.disabled = !isChecked;
                });
            }
        }
        
        function setupExport(buttonId, checkboxSelector, exportUrl, itemType) {
            const exportBtn = document.getElementById(buttonId);
            const checkboxes = document.querySelectorAll(checkboxSelector);

            const toggleExportButton = () => {
                const anyChecked = document.querySelectorAll(`${checkboxSelector}:checked`).length > 0;
                if(exportBtn) exportBtn.disabled = !anyChecked;
            };

            checkboxes.forEach(checkbox => checkbox.addEventListener('change', toggleExportButton));

            if (exportBtn) {
                exportBtn.addEventListener('click', function() {
                    const selectedIds = Array.from(document.querySelectorAll(`${checkboxSelector}:checked`)).map(cb => cb.dataset.id);
                    if (selectedIds.length === 0) {
                        alert(`Silakan pilih setidaknya satu ${itemType} untuk diekspor.`);
                        return;
                    }
                    try {
                        const url = new URL(exportUrl);
                        url.searchParams.append('ids', selectedIds.join(','));
                        window.location.href = url.toString();
                    } catch(e) {
                        alert("Terjadi kesalahan pada fitur export.");
                    }
                });
            }
        }

        function handleContractEdit(contractId) {
            const modal = document.getElementById('contractEditModal');
            const form = document.getElementById('contractEditForm');
            fetch(`/contracts/${contractId}`)
                .then(response => response.json())
                .then(data => {
                    form.action = `/contracts/${contractId}`;
                    for (const key in data) {
                        const input = document.getElementById(`edit_${key}`);
                        if (input) {
                            input.value = (input.type === 'date' && data[key]) ? data[key].split('T')[0] : data[key];
                        }
                    }
                    modal.classList.remove('hidden');
                });
        }

        function handleContractDelete(contractId) {
            const modal = document.getElementById('contractDeleteModal');
            const form = document.getElementById('contractDeleteForm');
            form.action = `/contracts/${contractId}`;
            modal.classList.remove('hidden');
        }

        // Jalankan inisialisasi.
        init();
    });
</script>
