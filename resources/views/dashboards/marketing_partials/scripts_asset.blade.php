<script>
    document.addEventListener('DOMContentLoaded', function() {

        /**
         * ===================================================================
         * FUNGSI BARU: Pencarian Sidebar
         * ===================================================================
         */
        function initSidebarSearch() {
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

        // Panggil fungsi pencarian sidebar saat halaman dimuat
        initSidebarSearch();
        initAssetTabs();


        /**
         * ===================================================================
         * FUNGSI YANG SUDAH ADA: Manajemen Tab, Modal, dan Tabel
         * =================================S==================================
         */

        // Fungsi untuk mengelola Tabs
        function initAssetTabs() {
            const tabs = document.querySelectorAll('#assetTabs .tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            const activeClasses = ['bg-slate-200', 'text-blue-800', 'shadow-md'];
            const inactiveClasses = ['text-gray-500', 'hover:bg-gray-100'];

            const showTab = (tabId) => {
                const targetTab = document.querySelector(`#assetTabs .tab-link[data-tab="${tabId}"]`);
                const targetContent = document.querySelector(`.tab-content[data-tab-content="${tabId}"]`);

                if (!targetTab) {
                    showTab('overview');
                    return;
                }

                tabs.forEach(t => {
                    t.classList.remove(...activeClasses);
                    t.classList.add(...inactiveClasses);
                });
                tabContents.forEach(c => c.classList.add('hidden'));

                targetTab.classList.remove(...inactiveClasses);
                targetTab.classList.add(...activeClasses);

                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }
            };

            tabs.forEach(tab => {
                // PERUBAHAN DI SINI
                tab.addEventListener('click', e => {
                    e.preventDefault(); // Mencegah default action dari link
                    const tabId = e.currentTarget.dataset.tab;

                    // Cek jika hash sudah sama, tidak perlu reload
                    if (window.location.hash !== `#${tabId}`) {
                        window.location.hash = tabId; // Set hash baru di URL
                        location.reload(); // Paksa halaman untuk me-refresh
                    }
                });
                // AKHIR PERUBAHAN
            });

            if (window.location.hash) {
                showTab(window.location.hash.substring(1));
            } else {
                showTab('overview');
            }
        }

        // Modal Input GSD
        document.getElementById('openGsdAssetInputModal')?.addEventListener('click', () => {
            document.getElementById('gsdAssetInputModal').classList.remove('hidden');
        });
        document.getElementById('cancelGsdAssetInputModal')?.addEventListener('click', () => {
            document.getElementById('gsdAssetInputModal').classList.add('hidden');
        });
        document.getElementById('closeGsdAssetInputModal')?.addEventListener('click', () => {
            document.getElementById('gsdAssetInputModal').classList.add('hidden');
        });
        document.getElementById('closeGsdAssetEditModal')?.addEventListener('click', () => {
            document.getElementById('gsdAssetEditModal').classList.add('hidden');
        });

        // Modal Edit GSD
        document.querySelectorAll('.edit-gsd-asset-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                const assetId = e.currentTarget.dataset.id;
                const modal = document.getElementById('gsdAssetEditModal');
                const form = document.getElementById('gsdAssetEditForm');

                // Anda perlu membuat route dan fungsi controller baru untuk ini
                fetch(`/gsd-assets/${assetId}`)
                    .then(res => res.json())
                    .then(data => {
                        form.action = `/gsd-assets/${assetId}`;
                        for (const key in data) {
                            const input = document.getElementById(`edit_gsd_${key}`);
                            if (input) input.value = data[key];
                        }
                        modal.classList.remove('hidden');
                    });
            });
        });
        document.getElementById('cancelGsdAssetEditModal')?.addEventListener('click', () => {
            document.getElementById('gsdAssetEditModal').classList.add('hidden');
        });

        // Modal Delete GSD
        document.querySelectorAll('.delete-gsd-asset-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                const assetId = e.currentTarget.dataset.id;
                const form = document.getElementById('gsdAssetDeleteForm');
                form.action = `/gsd-assets/${assetId}`; // Route untuk delete GSD
                document.getElementById('gsdAssetDeleteModal').classList.remove('hidden');
            });
        });
        document.getElementById('cancelGsdAssetDeleteModal')?.addEventListener('click', () => {
            document.getElementById('gsdAssetDeleteModal').classList.add('hidden');
        });

        // Fungsi pencarian tabel aset GSD
        document.getElementById('gsdAssetTableSearch')?.addEventListener('input', e => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('#gsdAssetTableBody .gsd-asset-row').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        // Fungsi Select All & Export untuk GSD
        const selectAllGsdCheckbox = document.getElementById('selectAllGsdAssetsCheckbox');
        const rowGsdCheckboxes = document.querySelectorAll('.gsd-asset-row-checkbox');
        const exportGsdBtn = document.getElementById('exportSelectedGsdAssetBtn');

        selectAllGsdCheckbox?.addEventListener('change', function() {
            rowGsdCheckboxes.forEach(cb => cb.checked = this.checked);
            if (exportGsdBtn) exportGsdBtn.disabled = !this.checked;
        });

        rowGsdCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                if (exportGsdBtn) exportGsdBtn.disabled = !document.querySelectorAll('.gsd-asset-row-checkbox:checked').length;
            });
        });

        // Modal Input
        document.getElementById('openAssetInputModal')?.addEventListener('click', () => {
            document.getElementById('assetInputModal').classList.remove('hidden');
        });
        document.getElementById('cancelAssetInputModal')?.addEventListener('click', () => {
            document.getElementById('assetInputModal').classList.add('hidden');
        });
        document.getElementById('closeAssetInputModal')?.addEventListener('click', () => {
            document.getElementById('assetInputModal').classList.add('hidden');
        });
        // Listener untuk tombol Batal Edit
        document.getElementById('cancelAssetEditModal')?.addEventListener('click', () => {
            document.getElementById('assetEditModal').classList.add('hidden');
        });

        // TAMBAHKAN INI: Listener untuk tombol 'X' (silang) Edit
        document.getElementById('closeAssetEditModal')?.addEventListener('click', () => {
            document.getElementById('assetEditModal').classList.add('hidden');
        });


        // Modal Edit
        document.querySelectorAll('.edit-asset-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                const assetId = e.currentTarget.dataset.id;
                const modal = document.getElementById('assetEditModal');
                const form = document.getElementById('assetEditForm');

                fetch(`/assets/${assetId}`)
                    .then(res => res.json())
                    .then(data => {
                        form.action = `/assets/${assetId}`;
                        for (const key in data) {
                            const input = document.getElementById(`edit_${key}`);
                            if (input) input.value = data[key];
                        }
                        modal.classList.remove('hidden');
                    });
            });
        });
        document.getElementById('cancelAssetEditModal')?.addEventListener('click', () => {
            document.getElementById('assetEditModal').classList.add('hidden');
        });

        // Modal Delete
        document.querySelectorAll('.delete-asset-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                const assetId = e.currentTarget.dataset.id;
                const form = document.getElementById('assetDeleteForm');
                form.action = `/assets/${assetId}`;
                document.getElementById('assetDeleteModal').classList.remove('hidden');
            });
        });
        document.getElementById('cancelAssetDeleteModal')?.addEventListener('click', () => {
            document.getElementById('assetDeleteModal').classList.add('hidden');
        });

        // Fungsi pencarian tabel aset
        document.getElementById('assetTableSearch')?.addEventListener('input', e => {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('#assetTableBody .asset-row').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        // Fungsi Select All & Export
        const selectAllCheckbox = document.getElementById('selectAllAssetsCheckbox');
        const rowCheckboxes = document.querySelectorAll('.asset-row-checkbox');
        const exportBtn = document.getElementById('exportSelectedAssetBtn');

        selectAllCheckbox?.addEventListener('change', function() {
            rowCheckboxes.forEach(cb => cb.checked = this.checked);
            if (exportBtn) exportBtn.disabled = !this.checked;
        });

        rowCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                if (exportBtn) exportBtn.disabled = !document.querySelectorAll('.asset-row-checkbox:checked').length;
            });
        });
    });
</script>