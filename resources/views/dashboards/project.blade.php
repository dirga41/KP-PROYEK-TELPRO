<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        /* Custom style untuk active tab */
        .tab-active {
            border-bottom: 2px solid #DC2626; /* red-600 */
            color: #1F2937; /* gray-800 */
        }
        .tab-inactive {
            border-bottom: 2px solid transparent;
            color: #6B7280; /* gray-500 */
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen bg-white">
    <!-- Sidebar -->
    <aside class="w-64 flex flex-col p-6 border-r border-gray-200">
        <!-- Logo -->
        <div class="mb-8">
            <img src="https://placehold.co/150x40/E53E3E/FFFFFF?text=Telkom+Property" alt="Logo Perusahaan" class="h-8 w-auto">
        </div>

        <!-- User Profile -->
        <div class="flex flex-col items-center text-center mb-8">
            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mb-3">
                <!-- Placeholder untuk foto profil -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Hi, {{ $user->name }}!</h2>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-6">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </span>
            <input id="searchInput" type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Search for...">
        </div>

        <!-- Navigation -->
        <nav id="mainNav" class="flex-grow">
            <ul>
                <li class="nav-item mb-2">
                    <a href="#" class="flex items-center p-3 text-gray-700 bg-red-100 rounded-lg font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                        Dashboard
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Logout Button -->
        <div class="mt-auto">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <!-- Header / Navbar -->
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <!-- Tabs -->
            <div class="mt-4 border-b border-gray-200">
                <nav id="tabs" class="-mb-px flex space-x-8" aria-label="Tabs">
                    <!-- Menambahkan data-tab untuk identifikasi -->
                    <a href="#" data-tab="overview" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-active">
                        Overview
                    </a>
                    <a href="#" data-tab="on-hand" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-inactive hover:text-gray-700 hover:border-gray-300">
                        Project On Hand
                    </a>
                    <a href="#" data-tab="planning" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-inactive hover:text-gray-700 hover:border-gray-300">
                        Project Planning
                    </a>
                </nav>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
            <!-- Menambahkan panel konten dengan data-tab-content -->
            <div id="overview-content" data-tab-content="overview" class="tab-content">
                <p class="text-gray-600">Konten untuk tab "Overview" akan ditampilkan di sini.</p>
            </div>
            <div id="on-hand-content" data-tab-content="on-hand" class="tab-content hidden">
                <p class="text-gray-600">Konten untuk tab "Project On Hand" akan ditampilkan di sini.</p>
            </div>
            <div id="planning-content" data-tab-content="planning" class="tab-content hidden">
                <p class="text-gray-600">Konten untuk tab "Project Planning" akan ditampilkan di sini.</p>
            </div>
        </div>
    </main>
</div>

<!-- JavaScript untuk fungsionalitas -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- FUNGSI SEARCH ---
        const searchInput = document.getElementById('searchInput');
        const navItems = document.querySelectorAll('#mainNav .nav-item');

        searchInput.addEventListener('input', function (e) {
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

        // --- FUNGSI TABS ---
        const tabs = document.querySelectorAll('#tabs .tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();

                // Hapus class active dari semua tab
                tabs.forEach(item => {
                    item.classList.remove('tab-active');
                    item.classList.add('tab-inactive');
                });

                // Tambahkan class active ke tab yang diklik
                this.classList.remove('tab-inactive');
                this.classList.add('tab-active');

                // Sembunyikan semua konten tab
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Tampilkan konten yang sesuai dengan tab yang diklik
                const targetContent = document.querySelector(`[data-tab-content="${this.dataset.tab}"]`);
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }
            });
        });
    });
</script>

</body>
</html>
