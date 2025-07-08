<!-- JavaScript untuk fungsionalitas -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- FUNGSI SEARCH ---
        const searchInput = document.getElementById('searchInput');
        const navItems = document.querySelectorAll('#mainNav .nav-item');

        searchInput.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            navItems.forEach(item => {
                const itemText = item.textContent.trim().toLowerCase();
                if (itemText.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // --- FUNGSI TABS ---
        const tabs = document.querySelectorAll('#tabs .tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
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
                const targetContent = document.querySelector(`[data-tab-content="${this.dataset.tab}"]`);
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }
            });
        });
    });
</script>
