<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Global reference untuk chart agar bisa dihancurkan
        let crmChart = null;
        // Global reference untuk fungsi update validasi timeline
        let updateTimelineValidationState = () => {};

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
            initDaysCountdown();
        }

        /**
         * Mengatur sistem navigasi tab.
         */
        /**
         * Mengatur sistem navigasi tab dengan gaya yang lebih presisi.
         */
        function initTabSystem() {
            const tabs = document.querySelectorAll('#tabs .tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            const activeClasses = [
                'bg-slate-200',
                'text-blue-800',
                'shadow-md',
                'rounded-full'
            ];

            const inactiveClasses = [
                'text-gray-500',
                'hover:bg-gray-100',
                'hover:text-gray-800'
            ];

            function showTab(tabId) {
                const targetTab = document.querySelector(`[data-tab="${tabId}"]`);
                if (!targetTab) {
                    showTab('overview');
                    return;
                }
                const targetContent = document.querySelector(`[data-tab-content="${tabId}"]`);

                tabs.forEach(item => {
                    item.classList.remove(...activeClasses);
                    item.classList.add(...inactiveClasses);
                });

                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                targetTab.classList.remove(...inactiveClasses);
                targetTab.classList.add(...activeClasses);
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }
            }

            tabs.forEach(tab => {
                // ================== PERUBAHAN DI SINI ==================
                tab.addEventListener('click', function(e) {
                    e.preventDefault(); // Mencegah perilaku default tautan
                    const tabId = this.dataset.tab;

                    // Hanya refresh halaman jika tab yang diklik berbeda dari yang aktif
                    if (window.location.hash !== `#${tabId}`) {
                        window.location.hash = tabId; // Atur hash di URL
                        location.reload(); // Kemudian, muat ulang halaman
                    }
                });
                // ================== AKHIR PERUBAHAN ==================
            });

            // Logika untuk memuat tab berdasarkan URL hash
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
         * [MODIFIED] Menginisialisasi countdown sisa hari dengan label berwarna.
         */
        function initDaysCountdown() {
            const countdownElements = document.querySelectorAll('.countdown-days');
            const now = new Date();
            now.setHours(0, 0, 0, 0);

            countdownElements.forEach(el => {
                const tocDateString = el.dataset.toc;

                if (tocDateString && tocDateString.trim() !== '') {
                    const tocDate = new Date(tocDateString);
                    tocDate.setHours(0, 0, 0, 0);

                    const timeDiff = tocDate.getTime() - now.getTime();

                    if (timeDiff < 0) {
                        // Label untuk proyek yang sudah selesai
                        el.innerHTML = '<span class="bg-gray-200 text-gray-800 py-1 px-3 rounded-full text-xs">Selesai</span>';
                    } else {
                        const daysLeft = Math.ceil(timeDiff / (1000 * 3600 * 24));
                        let labelClass = '';

                        // Menentukan warna label berdasarkan sisa hari
                        if (daysLeft <= 10) {
                            labelClass = 'bg-red-200 text-red-800'; // Merah
                        } else if (daysLeft <= 20) {
                            labelClass = 'bg-yellow-200 text-yellow-800'; // Kuning
                        } else {
                            labelClass = 'bg-green-200 text-green-800'; // Hijau
                        }

                        // Menampilkan label dengan warna yang sesuai
                        el.innerHTML = `<span class="${labelClass} py-1 px-3 rounded-full text-xs">${daysLeft} hari</span>`;
                    }
                } else {
                    // Label untuk data yang tidak memiliki tanggal TOC
                    el.innerHTML = '<span class="bg-gray-200 text-gray-800 py-1 px-3 rounded-full text-xs">-</span>';
                }
            });
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
            setupModal('inputModal', '#openInputModal', 'closeInputModal', 'cancelInputModal', () => {
                const jenisPengadaanInput = document.getElementById('jenis_pengadaan');
                const statusPanjarInput = document.getElementById('status_panjar');

                const toggleStatusPanjar = () => {
                    if (jenisPengadaanInput.value === 'mitra') {
                        statusPanjarInput.disabled = true;
                        statusPanjarInput.value = '';
                    } else {
                        statusPanjarInput.disabled = false;
                    }
                };

                jenisPengadaanInput.removeEventListener('change', toggleStatusPanjar);
                jenisPengadaanInput.addEventListener('change', toggleStatusPanjar);

                toggleStatusPanjar();
            });
            setupModal('editModal', '.edit-btn', 'closeEditModal', 'cancelEditModal', handleProjectEdit);
            setupModal('viewModal', '.view-btn', 'closeViewModal', 'cancelViewModal', handleProjectView);
            setupModal('deleteModal', '.delete-btn', null, 'cancelDeleteModal', handleProjectDelete);
            setupExport('exportButton', '.row-checkbox', '{{ route("projects.export") }}', 'proyek');
            setupSelectAll('selectAllCheckbox', '.row-checkbox');
            // Panggil fungsi setup untuk validasi timeline
            updateTimelineValidationState = setupTimelineValidation();
        }

        /**
         * Fungsi untuk setup validasi urutan tanggal pada timeline CRM.
         */
        function setupTimelineValidation() {
            const timelineInputIds = [
                'edit_spk_date', 'edit_leads_date', 'edit_approval_jib_date',
                'edit_contract_date', 'edit_procurement_juskeb_date',
                'edit_procurement_rb_date', 'edit_procurement_juspeng_date'
            ];
            const timelineInputs = timelineInputIds.map(id => document.getElementById(id));

            const updateStates = () => {
                let previousInputHasValue = true;
                for (const input of timelineInputs) {
                    if (!input) continue; // Lewati jika elemen tidak ditemukan

                    if (previousInputHasValue) {
                        input.disabled = false;
                        input.title = ''; // Hapus tooltip jika aktif
                    } else {
                        input.disabled = true;
                        input.title = 'Harap isi tahap sebelumnya terlebih dahulu.'; // Tambahkan tooltip sebagai petunjuk
                    }
                    previousInputHasValue = !!input.value;
                }
            };

            timelineInputs.forEach(input => {
                if (input) {
                    input.addEventListener('input', updateStates);
                }
            });

            // Kembalikan fungsi agar bisa dipanggil saat modal dibuka
            return updateStates;
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
            // [MODIFIKASI] setupModal untuk input dihapus
            // setupModal('rkapInputModal', '#openRkapInputModal', 'closeRkapInputModal', 'cancelRkapInputModal');
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
                    const statusLabels = {
                        'ongoing': 'On Going',
                        'closed': 'Closed',
                        'closed adm': 'Closed Adm',
                        'not started': 'Not Started'
                    };
                    const statusColors = {
                        'ongoing': 'rgba(59, 130, 246, 0.7)',
                        'closed': 'rgba(34, 197, 94, 0.7)',
                        'closed adm': 'rgba(234, 179, 8, 0.7)',
                        'not started': 'rgba(156, 163, 175, 0.7)'
                    };
                    const datasets = statuses.map(status => ({
                        label: statusLabels[status],
                        data: segments.map(segment => chartData[segment][status] || 0),
                        backgroundColor: statusColors[status],
                        borderColor: statusColors[status].replace('0.7', '1'),
                        borderWidth: 1
                    }));
                    new Chart(chartCanvas, {
                        type: 'bar',
                        data: {
                            labels: segments,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    stacked: true
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            }
                        }
                    });
                } catch (e) {
                    console.error("Gagal mem-parsing data chart:", e);
                }
            }

            const valueChartCanvas = document.getElementById('valueComparisonChart');
            if (valueChartCanvas) {
                try {
                    const onHandValue = parseFloat(valueChartCanvas.dataset.onHandValue) || 0;
                    const planningValue = parseFloat(valueChartCanvas.dataset.planningValue) || 0;
                    const totalValue = onHandValue + planningValue;
                    new Chart(valueChartCanvas, {
                        type: 'doughnut',
                        data: {
                            labels: ['On Hand', 'Planning'],
                            datasets: [{
                                label: 'Nilai Project',
                                data: [onHandValue, planningValue],
                                backgroundColor: ['#F7C59F', '#D35400'],
                                borderColor: '#FFFFFF',
                                borderWidth: 4,
                                hoverOffset: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '70%',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const percentage = totalValue > 0 ? ((value / totalValue) * 100).toFixed(0) : 0;
                                            const formattedValue = new Intl.NumberFormat('id-ID', {
                                                style: 'currency',
                                                currency: 'IDR',
                                                minimumFractionDigits: 0
                                            }).format(value);
                                            context.chart.options.plugins.tooltip.title = `${percentage}%`;
                                            return ` ${label}: ${formattedValue}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                } catch (e) {
                    console.error("Gagal membuat chart perbandingan nilai:", e);
                }
            }
        }

        function setupModal(modalId, openTriggerSelector, closeBtnId, cancelBtnId, onOpen) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            const openTriggers = document.querySelectorAll(openTriggerSelector);
            const closeBtn = closeBtnId ? document.getElementById(closeBtnId) : null;
            const cancelBtn = cancelBtnId ? document.getElementById(cancelBtnId) : null;
            const openModal = (event) => {
                modal.classList.remove('hidden');
                if (onOpen) {
                    event.preventDefault();
                    onOpen(event.currentTarget.dataset.id);
                }
            };
            const closeModal = () => modal.classList.add('hidden');
            openTriggers.forEach(trigger => trigger.addEventListener('click', openModal));
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        }

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
                    } catch (e) {
                        console.error("URL untuk export tidak valid:", exportUrl, e);
                        alert("Terjadi kesalahan pada fitur export.");
                    }
                });
            }
        }

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
            const jenisPengadaanInput = document.getElementById('edit_jenis_pengadaan');
            const statusPanjarInput = document.getElementById('edit_status_panjar');

            const formatDateForInput = (dateString) => {
                if (!dateString) return '';
                return new Date(dateString).toISOString().slice(0, 10);
            };

            // [MODIFIED] Logic to disable/enable 'Status Panjar'
            const toggleStatusPanjarState = () => {
                if (jenisPengadaanInput.value === 'mitra') {
                    statusPanjarInput.disabled = true;
                    statusPanjarInput.value = ''; // Clear value when disabled
                } else {
                    statusPanjarInput.disabled = false;
                }
            };

            jenisPengadaanInput.removeEventListener('change', toggleStatusPanjarState); // Remove old listener to prevent duplicates
            jenisPengadaanInput.addEventListener('change', toggleStatusPanjarState);


            fetch(`/projects/${projectId}`)
                .then(response => response.json())
                .then(data => {
                    form.action = `/projects/${projectId}`;
                    document.getElementById('edit_nilai_kontrak').value = parseFloat(data.nilai_kontrak);
                    document.getElementById('edit_status_progres').value = data.status_progres;

                    // Set values for 'Jenis Pengadaan' and 'Status Panjar'
                    jenisPengadaanInput.value = data.jenis_pengadaan || '';
                    statusPanjarInput.value = data.status_panjar || '';

                    // [MODIFIED] Set initial state for 'Status Panjar'
                    toggleStatusPanjarState();

                    // [FIX] Mengatur batas min dan max untuk semua input tanggal linimasa
                    const minDate = formatDateForInput(data.tanggal_kontrak);
                    const maxDate = formatDateForInput(data.toc);

                    const timelineInputIds = [
                        'edit_spk_date', 'edit_leads_date', 'edit_approval_jib_date',
                        'edit_contract_date', 'edit_procurement_juskeb_date',
                        'edit_procurement_rb_date', 'edit_procurement_juspeng_date'
                    ];

                    timelineInputIds.forEach(id => {
                        const input = document.getElementById(id);
                        if (input) {
                            if (minDate) {
                                input.min = minDate;
                            }
                            if (maxDate) {
                                input.max = maxDate;
                            }
                        }
                    });

                    // Mengisi nilai tanggal yang sudah ada
                    document.getElementById('edit_toc_date').value = formatDateForInput(data.toc);
                    document.getElementById('edit_spk_date').value = formatDateForInput(data.spk_date);
                    document.getElementById('edit_leads_date').value = formatDateForInput(data.leads_date);
                    document.getElementById('edit_approval_jib_date').value = formatDateForInput(data.approval_jib_date);
                    document.getElementById('edit_contract_date').value = formatDateForInput(data.contract_date);
                    document.getElementById('edit_procurement_juskeb_date').value = formatDateForInput(data.procurement_juskeb_date);
                    document.getElementById('edit_procurement_rb_date').value = formatDateForInput(data.procurement_rb_date);
                    document.getElementById('edit_procurement_juspeng_date').value = formatDateForInput(data.procurement_juspeng_date);

                    // Panggil fungsi untuk mengatur status awal input (disabled/enabled)
                    updateTimelineValidationState();

                    modal.classList.remove('hidden');
                });
        }

        function handleProjectView(projectId) {
            const modal = document.getElementById('viewModal');
            const content = document.getElementById('viewModalContent');
            fetch(`/projects/${projectId}`)
                .then(response => response.json())
                .then(data => {
                    const tglKontrak = new Date(data.tanggal_kontrak).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                    const tglToc = data.toc ? new Date(data.toc).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }) : '-';
                    const nilaiKontrak = new Intl.NumberFormat('id-ID').format(data.nilai_kontrak);

                    // [MODIFIED] Conditionally show 'Status Panjar'
                    const statusPanjarHtml = data.jenis_pengadaan !== 'mitra' ?
                        `<p><strong class="font-semibold text-gray-600">Status Panjar:</strong><br>${data.status_panjar || '-'}</p>` :
                        '';

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
                            ${statusPanjarHtml}
                        </div>`;

                    // [MODIFIED] Konfigurasi chart diubah agar sesuai dengan gambar
                    try {
                        const ctx = document.getElementById('crmTimelineChart').getContext('2d');
                        if (crmChart) {
                            crmChart.destroy();
                        }

                        const timelineLabels = ['SPK', 'LEADS', 'APPROVAL JIB', 'CONTRACT', 'PROCUREMENT - JUSKEB', 'PROCUREMENT - RB', 'PROCUREMENT - JUSPENG'];
                        const crmData = [
                            data.spk_date, data.leads_date, data.approval_jib_date, data.contract_date,
                            data.procurement_juskeb_date, data.procurement_rb_date, data.procurement_juspeng_date,
                        ];
                        const tocData = timelineLabels.map(() => data.toc);

                        const chartOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    grid: {
                                        display: false // Menghilangkan grid vertikal
                                    }
                                },
                                y: {
                                    type: 'time',
                                    time: {
                                        tooltipFormat: 'dd MMM yyyy'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Date'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    mode: 'nearest', // Diubah dari 'index' ke 'nearest'
                                    intersect: true, // Diubah ke true agar tooltip hanya muncul saat kursor tepat di atas titik
                                    displayColors: true,
                                    callbacks: {
                                        // Format tooltip agar lebih sesuai dengan contoh
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed.y !== null) {
                                                const date = new Date(context.parsed.y);
                                                label += date.toLocaleDateString('id-ID', {
                                                    day: 'numeric',
                                                    month: 'short',
                                                    year: 'numeric'
                                                });
                                            }
                                            return label;
                                        }
                                    }
                                }
                            }
                        };

                        if (data.tanggal_kontrak && data.toc) {
                            chartOptions.scales.y.min = data.tanggal_kontrak;
                            chartOptions.scales.y.max = data.toc;
                        }

                        crmChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: timelineLabels,
                                datasets: [{
                                    label: 'STAGE CRM',
                                    data: crmData,
                                    borderColor: 'rgb(59, 130, 246)',
                                    backgroundColor: 'rgb(59, 130, 246)',
                                    fill: false,
                                    tension: 0.2,
                                    pointRadius: 4, // Menampilkan titik secara default
                                    pointHoverRadius: 7, // Memperbesar titik saat hover
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    pointHoverBackgroundColor: '#fff',
                                    pointHoverBorderColor: 'rgb(59, 130, 246)',
                                }, {
                                    label: 'TOC',
                                    data: tocData,
                                    borderColor: 'rgb(239, 68, 68)',
                                    backgroundColor: 'rgb(239, 68, 68)',
                                    fill: false,
                                    tension: 0.2,
                                    pointRadius: 4, // Menampilkan titik secara default
                                    pointHoverRadius: 7, // Memperbesar titik saat hover
                                    pointHitRadius: 10,
                                    pointBorderWidth: 2,
                                    pointHoverBackgroundColor: '#fff',
                                    pointHoverBorderColor: 'rgb(239, 68, 68)',
                                }]
                            },
                            options: chartOptions
                        });
                    } catch (error) {
                        console.error("Gagal membuat bagan linimasa:", error);
                    }

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

                    // [MODIFIKASI] Mengisi nilai dan membuat field Bulan & Periode read-only
                    const bulanInput = document.getElementById('edit_rkap_bulan');
                    const periodeInput = document.getElementById('edit_rkap_periode');

                    bulanInput.value = data.bulan;
                    bulanInput.setAttribute('readonly', true); // Membuat field tidak bisa diedit

                    periodeInput.value = data.periode;
                    periodeInput.setAttribute('readonly', true); // Membuat field tidak bisa diedit

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