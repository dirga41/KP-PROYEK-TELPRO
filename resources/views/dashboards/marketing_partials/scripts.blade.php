<script>
    document.addEventListener('DOMContentLoaded', function() {

        /**
         * ===================================================================
         * FUNGSI INISIALISASI UTAMA
         * ===================================================================
         */
        function init() {
            initSidebarSearch();
            initTabs(); // <-- Fungsi ini akan kita ganti
            initContractFeatures();
            initDynamicDonutChart();
        }


        /**
         * ===================================================================
         * FUNGSI-FUNGSI APLIKASI
         * ===================================================================
         */

        function initDynamicDonutChart() {
            // ... (kode donut chart Anda yang sudah ada, tidak perlu diubah)
            const container = document.getElementById('donutChartContainer');
            if (!container) return;
            const svg = document.getElementById('donutChartSvg');
            const legend = document.getElementById('donutChartLegend');
            const dataString = container.dataset.segments;
            if (!dataString || !svg || !legend) return;
            try {
                const segments = JSON.parse(dataString);
                if (segments.length === 0) return;
                let offset = 0;
                svg.querySelectorAll('path.segment').forEach(path => path.remove());
                legend.innerHTML = '';
                segments.forEach(segment => {
                    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    path.setAttribute('class', `segment ${segment.color}`);
                    path.setAttribute('stroke', 'currentColor');
                    path.setAttribute('stroke-width', '4');
                    path.setAttribute('fill', 'none');
                    path.setAttribute('stroke-dasharray', `${segment.percentage}, 100`);
                    path.setAttribute('stroke-dashoffset', `-${offset}`);
                    path.setAttribute('d', 'M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831');
                    svg.appendChild(path);
                    offset += segment.percentage;
                    const li = document.createElement('li');
                    li.className = 'flex items-center mb-2';
                    const colorDot = document.createElement('span');
                    const bgColorClass = segment.color.replace('text-', 'bg-');
                    colorDot.className = `w-3 h-3 rounded-full ${bgColorClass} mr-2`;
                    const text = document.createElement('span');
                    text.textContent = `${segment.name} (${segment.percentage}%)`;
                    li.appendChild(colorDot);
                    li.appendChild(text);
                    legend.appendChild(li);
                });

                function resizeChart() {
                    const width = container.offsetWidth;
                    container.style.height = `${width}px`;
                }
                resizeChart();
                window.addEventListener('resize', resizeChart);
            } catch (e) {
                console.error("Gagal mem-parsing data chart:", e);
            }
        }

        function initSidebarSearch() {
            // ... (kode pencarian sidebar Anda, tidak perlu diubah)
            const searchInput = document.getElementById('sidebarSearchInput');
            if (!searchInput) return;
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const navItems = document.querySelectorAll('#mainNav .nav-item');
                navItems.forEach(item => {
                    const menuText = item.textContent.toLowerCase();
                    if (menuText.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // ===================================================================
        // FUNGSI TAB YANG DIPERBARUI
        // ===================================================================
        function initTabs() {
            const tabs = document.querySelectorAll('#tabs .tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            const activeClasses = ['bg-slate-200', 'text-blue-800', 'shadow-md'];
            const inactiveClasses = ['text-gray-500', 'hover:bg-gray-100'];

            function showTab(tabId) {
                const targetTab = document.querySelector(`a.tab-link[data-tab="${tabId}"]`);
                const targetContent = document.querySelector(`div.tab-content[data-tab-content="${tabId}"]`);

                if (!targetTab || !targetContent) {
                    if (tabId !== 'overview') showTab('overview');
                    return;
                }

                tabs.forEach(t => {
                    t.classList.remove(...activeClasses);
                    t.classList.add(...inactiveClasses);
                });
                tabContents.forEach(c => c.classList.add('hidden'));

                targetTab.classList.remove(...inactiveClasses);
                targetTab.classList.add(...activeClasses);
                targetContent.classList.remove('hidden');
            };

            tabs.forEach(tab => {
                // PERUBAHAN DI SINI
                tab.addEventListener('click', function(e) {
                    e.preventDefault(); // Mencegah default action
                    const tabId = this.dataset.tab;

                    // Hanya reload jika hash URL berbeda
                    if (window.location.hash !== `#${tabId}`) {
                        window.location.hash = tabId; // Atur hash di URL
                        location.reload(); // Lalu refresh halaman
                    }
                });
                // AKHIR PERUBAHAN
            });

            if (window.location.hash) {
                const tabIdFromHash = window.location.hash.substring(1);
                showTab(tabIdFromHash);
            } else {
                showTab('overview');
            }
        }

        function initContractFeatures() {
            // ... (kode fitur kontrak Anda, tidak perlu diubah)
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
            // ... (kode modal Anda, tidak perlu diubah)
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

        // ... (sisa fungsi Anda seperti setupTableSearch, handleContractEdit, dll. tetap di sini)
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
                    if (exportBtn) exportBtn.disabled = !isChecked;
                });
            }
        }

        function setupExport(buttonId, checkboxSelector, exportUrl, itemType) {
            const exportBtn = document.getElementById(buttonId);
            const checkboxes = document.querySelectorAll(checkboxSelector);
            const toggleExportButton = () => {
                const anyChecked = document.querySelectorAll(`${checkboxSelector}:checked`).length > 0;
                if (exportBtn) exportBtn.disabled = !anyChecked;
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
                    } catch (e) {
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


        // Jalankan semua fungsi inisialisasi.
        init();
    });
</script>