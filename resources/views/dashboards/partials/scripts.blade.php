<script>
    document.addEventListener('DOMContentLoaded', function() {

        /**
         * Menginisialisasi semua fungsionalitas pada halaman.
         */
        function init() {
            initTabSystem();
            initSearch();
            initProjectFeatures();
            initProjectPlanFeatures();
            initRkapFeatures();
            initOverviewCharts();
        }

        /**
         * Mengatur sistem navigasi tab.
         */
        function initTabSystem() {
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

            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tabId = this.dataset.tab;
                    showTab(tabId);
                    window.location.hash = tabId;
                });
            });

            if (window.location.hash) {
                const hash = window.location.hash.substring(1);
                showTab(hash);
            } else {
                showTab('overview');
            }
        }

        /**
         * Mengatur fungsionalitas pencarian.
         */
        function initSearch() {
            setupTableSearch('sidebarSearchInput', 'nav ul li a', (item, term) => item.parentElement.style.display = item.textContent.toLowerCase().includes(term) ? 'block' : 'none');
            setupTableSearch('projectTableSearch', '#projectTableBody .project-row');
            setupTableSearch('planTableSearch', '#planTableBody .plan-row');
            setupTableSearch('rkapTableSearch', '#rkapTableBody .rkap-row');
        }

        /**
         * Fungsi generik untuk pencarian.
         */
        function setupTableSearch(inputId, rowSelector, displayLogic) {
            const searchInput = document.getElementById(inputId);
            if (searchInput) {
                const rows = document.querySelectorAll(rowSelector);
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    rows.forEach(row => {
                        if (displayLogic) {
                            displayLogic(row, searchTerm);
                        } else {
                            row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? 'table-row' : 'none';
                        }
                    });
                });
            }
        }

        /**
         * Inisialisasi fitur "Project On Hand".
         */
        function initProjectFeatures() {
            setupModal('inputModal', '#openInputModal', 'closeInputModal', 'cancelInputModal');
            setupModal('editModal', '.edit-btn', 'closeEditModal', 'cancelEditModal', handleProjectEdit);
            setupModal('viewModal', '.view-btn', 'closeViewModal', 'cancelViewModal', handleProjectView);
            setupModal('deleteModal', '.delete-btn', null, 'cancelDeleteModal', handleProjectDelete);
            setupExport('exportButton', '.row-checkbox', '{{ route("projects.export") }}', 'proyek');
            setupSelectAll('selectAllCheckbox', '.row-checkbox');
        }

        /**
         * Inisialisasi fitur "Project Planning".
         */
        function initProjectPlanFeatures() {
            setupModal('planInputModal', '#openPlanInputModal', 'closePlanInputModal', 'cancelPlanInputModal');
            setupModal('planEditModal', '.edit-plan-btn', 'closePlanEditModal', 'cancelPlanEditModal', handlePlanEdit);
            setupModal('planViewModal', '.view-plan-btn', 'closePlanViewModal', 'cancelPlanViewModal', handlePlanView);
            setupModal('planDeleteModal', '.delete-plan-btn', null, 'cancelPlanDeleteModal', handlePlanDelete);
            setupExport('exportPlansButton', '.plan-row-checkbox', '{{ route("project-plans.export") }}', 'rencana proyek');
            setupSelectAll('selectAllPlansCheckbox', '.plan-row-checkbox');
        }

        /**
         * Inisialisasi fitur "RKAP Vs Realisasi".
         */
        function initRkapFeatures() {
            setupModal('rkapInputModal', '#openRkapInputModal', 'closeRkapInputModal', 'cancelRkapInputModal');
            setupModal('rkapEditModal', '.edit-rkap-btn', 'closeRkapEditModal', 'cancelRkapEditModal', handleRkapEdit);
            setupModal('rkapDeleteModal', '.delete-rkap-btn', null, 'cancelRkapDeleteModal', handleRkapDelete);
            setupExport('exportRkapButton', '.rkap-row-checkbox', '{{ route("rkaps.export") }}', 'RKAP');
            setupSelectAll('selectAllRkapCheckbox', '.rkap-row-checkbox');
        }

        /**
         * Inisialisasi Chart untuk Tab Overview.
         */
        function initOverviewCharts() {
            const chartCanvas = document.getElementById('projectStatusChart');
            if (typeof Chart === 'undefined') {
                console.error('Chart.js tidak ter-load. Pastikan script tag untuk Chart.js ada dan berhasil dimuat sebelum script ini.');
                return;
            }

            if (chartCanvas && chartCanvas.dataset.chartData) {
                try {
                    const chartData = JSON.parse(chartCanvas.dataset.chartData);
                    const segments = Object.keys(chartData);
                    const statuses = ['ongoing', 'closed', 'closed adm', 'not started'];
                    const statusLabels = { 'ongoing': 'On Going', 'closed': 'Closed', 'closed adm': 'Closed Adm', 'not started': 'Not Started' };
                    const statusColors = { 'ongoing': 'rgba(59, 130, 246, 0.7)', 'closed': 'rgba(34, 197, 94, 0.7)', 'closed adm': 'rgba(234, 179, 8, 0.7)', 'not started': 'rgba(156, 163, 175, 0.7)' };

                    const datasets = statuses.map(status => ({
                        label: statusLabels[status],
                        data: segments.map(segment => chartData[segment][status] || 0),
                        backgroundColor: statusColors[status],
                        borderColor: statusColors[status].replace('0.7', '1'),
                        borderWidth: 1
                    }));

                    new Chart(chartCanvas, {
                        type: 'bar',
                        data: { labels: segments, datasets: datasets },
                        options: {
                            responsive: true,
                            scales: { x: { stacked: true }, y: { stacked: true, beginAtZero: true, ticks: { stepSize: 1 } } },
                            plugins: { legend: { position: 'top' }, tooltip: { mode: 'index', intersect: false } }
                        }
                    });
                } catch (e) {
                    console.error("Gagal mem-parsing data chart:", e);
                }
            }
        }

        /**
         * PERBAIKAN: Fungsi generik untuk setup modal yang lebih robust.
         * Event listener sekarang ditambahkan langsung ke tombol, bukan ke body.
         */
        function setupModal(modalId, openTriggerSelector, closeBtnId, cancelBtnId, onOpen) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            
            const openTriggers = document.querySelectorAll(openTriggerSelector);
            const closeBtn = closeBtnId ? document.getElementById(closeBtnId) : null;
            const cancelBtn = cancelBtnId ? document.getElementById(cancelBtnId) : null;

            const openModal = (event) => {
                if (onOpen) {
                    event.preventDefault();
                    onOpen(event.currentTarget.dataset.id);
                } else {
                    modal.classList.remove('hidden');
                }
            };
            
            const closeModal = () => modal.classList.add('hidden');

            openTriggers.forEach(trigger => {
                trigger.addEventListener('click', openModal);
            });

            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        }

        /**
         * Fungsi generik untuk setup export.
         */
        function setupExport(buttonId, checkboxSelector, exportUrl, itemType) {
            const exportBtn = document.getElementById(buttonId);
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
                        console.error("URL untuk export tidak valid:", exportUrl, e);
                        alert("Terjadi kesalahan pada fitur export.");
                    }
                });
            }
        }

        /**
         * Fungsi generik untuk setup "pilih semua".
         */
        function setupSelectAll(selectAllId, rowCheckboxSelector) {
            const selectAll = document.getElementById(selectAllId);
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    document.querySelectorAll(rowCheckboxSelector).forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }
        }

        // --- CALLBACKS UNTUK MODAL ---
        
        function handleProjectEdit(projectId) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            fetch(`/projects/${projectId}`)
                .then(response => response.json())
                .then(data => {
                    form.action = `/projects/${projectId}`;
                    document.getElementById('edit_nilai_kontrak').value = parseFloat(data.nilai_kontrak);
                    document.getElementById('edit_status_progres').value = data.status_progres;
                    document.getElementById('edit_jenis_pengadaan').value = data.jenis_pengadaan || '';
                    document.getElementById('edit_status_panjar').value = data.status_panjar || '';
                    modal.classList.remove('hidden');
                });
        }

        function handleProjectView(projectId) {
            const modal = document.getElementById('viewModal');
            const content = document.getElementById('viewModalContent');
            fetch(`/projects/${projectId}`)
                .then(response => response.json())
                .then(data => {
                    const tglKontrak = new Date(data.tanggal_kontrak).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
                    const tglToc = data.toc ? new Date(data.toc).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) : '-';
                    const nilaiKontrak = new Intl.NumberFormat('id-ID').format(data.nilai_kontrak);

                    content.innerHTML = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <p><strong class="font-semibold text-gray-600">Project:</strong><br>${data.project || '-'}</p>
                            <p><strong class="font-semibold text-gray-600">No Kontrak:</strong><br>${data.no_kontrak || '-'}</p>
                            <p><strong class="font-semibold text-gray-600">Segment:</strong><br>${data.segment || '-'}</p>
                            <p><strong class="font-semibold text-gray-600">Area:</strong><br>${data.area || '-'}</p>
                            <p><strong class="font-semibold text-gray-600">Tanggal Kontrak:</strong><br>${tglKontrak}</p>
                            <p><strong class="font-semibold text-gray-600">Nilai Kontrak:</strong><br>Rp ${nilaiKontrak}</p>
                            <p><strong class="font-semibold text-gray-600">Tanggal TOC:</strong><br>${tglToc}</p>
                            <p><strong class="font-semibold text-gray-600">Status:</strong><br>${data.status_progres || '-'}</p>
                            <p><strong class="font-semibold text-gray-600">Jenis Pengadaan:</strong><br>${data.jenis_pengadaan || '-'}</p>
                            <p><strong class="font-semibold text-gray-600">Status Panjar:</strong><br>${data.status_panjar || '-'}</p>
                        </div>`;
                    modal.classList.remove('hidden');
                });
        }

        function handleProjectDelete(projectId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/projects/${projectId}`;
            modal.classList.remove('hidden');
        }

        function handlePlanEdit(planId) {
            const modal = document.getElementById('planEditModal');
            const form = document.getElementById('planEditForm');
            fetch(`/project-plans/${planId}`)
                .then(response => response.json())
                .then(data => {
                    form.action = `/project-plans/${planId}`;
                    document.getElementById('edit_plan_project').value = data.project;
                    document.getElementById('edit_plan_user').value = data.user;
                    document.getElementById('edit_plan_lokasi').value = data.lokasi;
                    document.getElementById('edit_plan_estimasi_nilai').value = parseFloat(data.estimasi_nilai);
                    document.getElementById('edit_plan_update_info').value = data.update_info;
                    modal.classList.remove('hidden');
                });
        }

        function handlePlanView(planId) {
            const modal = document.getElementById('planViewModal');
            const content = document.getElementById('planViewModalContent');
            fetch(`/project-plans/${planId}`)
                .then(response => response.json())
                .then(data => {
                    const estimasiNilai = new Intl.NumberFormat('id-ID').format(data.estimasi_nilai);
                    content.innerHTML = `
                        <div class="grid grid-cols-2 gap-4">
                            <p><strong>Project:</strong><br>${data.project}</p>
                            <p><strong>User:</strong><br>${data.user}</p>
                            <p><strong>Lokasi:</strong><br>${data.lokasi}</p>
                            <p><strong>Estimasi Nilai:</strong><br>Rp ${estimasiNilai}</p>
                            <div class="col-span-2"><p><strong>Update Info:</strong><br>${data.update_info || '-'}</p></div>
                        </div>`;
                    modal.classList.remove('hidden');
                });
        }

        function handlePlanDelete(planId) {
            const modal = document.getElementById('planDeleteModal');
            const form = document.getElementById('planDeleteForm');
            form.action = `/project-plans/${planId}`;
            modal.classList.remove('hidden');
        }
        
        function handleRkapEdit(rkapId) {
            const modal = document.getElementById('rkapEditModal');
            const form = document.getElementById('rkapEditForm');
            fetch(`/rkaps/${rkapId}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    if (!data || Object.keys(data).length === 0) {
                        alert('Gagal memuat data. Data yang diterima dari server kosong.');
                        return;
                    }
                    form.action = `/rkaps/${rkapId}`;
                    document.getElementById('edit_rkap_bulan').value = data.bulan;
                    document.getElementById('edit_rkap_periode').value = data.periode;
                    document.getElementById('edit_rkap_value').value = parseFloat(data.rkap_value);
                    document.getElementById('edit_project_2025_value').value = parseFloat(data.project_2025_value);
                    document.getElementById('edit_rev_co_project_2024_sap_value').value = parseFloat(data.rev_co_project_2024_sap_value);
                    document.getElementById('edit_project_2025_co_value').value = parseFloat(data.project_2025_co_value);
                    modal.classList.remove('hidden');
                });
        }

        function handleRkapDelete(rkapId) {
            const modal = document.getElementById('rkapDeleteModal');
            const form = document.getElementById('rkapDeleteForm');
            form.action = `/rkaps/${rkapId}`;
            modal.classList.remove('hidden');
        }

        // Jalankan inisialisasi
        init();
    });
</script>
