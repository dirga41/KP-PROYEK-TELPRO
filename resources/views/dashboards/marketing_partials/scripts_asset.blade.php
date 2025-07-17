<script>
document.addEventListener('DOMContentLoaded', function () {
    
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


    /**
     * ===================================================================
     * FUNGSI YANG SUDAH ADA: Manajemen Tab, Modal, dan Tabel
     * =================================S==================================
     */

    // Fungsi untuk mengelola Tabs
    const tabs = document.querySelectorAll('#assetTabs .tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    const showTab = (tabId) => {
        const targetTab = document.querySelector(`.tab-link[data-tab="${tabId}"]`);
        const targetContent = document.querySelector(`.tab-content[data-tab-content="${tabId}"]`);

        if (!targetTab || !targetContent) {
            if (tabId !== 'overview') showTab('overview');
            return;
        }

        tabs.forEach(t => {
            t.classList.remove('tab-active');
            t.classList.add('tab-inactive');
        });
        tabContents.forEach(c => c.classList.add('hidden'));
        
        targetTab.classList.remove('tab-inactive');
        targetTab.classList.add('tab-active');
        targetContent.classList.remove('hidden');
    };

    tabs.forEach(tab => {
        tab.addEventListener('click', e => {
            e.preventDefault();
            const tabId = e.currentTarget.dataset.tab;
            window.history.pushState(null, null, `#${tabId}`);
            showTab(tabId);
        });
    });

    if (window.location.hash) {
        showTab(window.location.hash.substring(1));
    } else {
        showTab('overview');
    }

    // Modal Input
    document.getElementById('openAssetInputModal')?.addEventListener('click', () => {
        document.getElementById('assetInputModal').classList.remove('hidden');
    });
    document.getElementById('cancelAssetInputModal')?.addEventListener('click', () => {
        document.getElementById('assetInputModal').classList.add('hidden');
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
        if(exportBtn) exportBtn.disabled = !this.checked;
    });

    rowCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            if(exportBtn) exportBtn.disabled = !document.querySelectorAll('.asset-row-checkbox:checked').length;
        });
    });
});
</script>