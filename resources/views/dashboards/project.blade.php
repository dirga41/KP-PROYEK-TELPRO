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

        /* Custom style untuk active tab */
        .tab-active {
            border-bottom: 2px solid #DC2626;
            /* red-600 */
            color: #1F2937;
            /* gray-800 */
        }

        .tab-inactive {
            border-bottom: 2px solid transparent;
            color: #6B7280;
            /* gray-500 */
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="flex h-screen bg-white">
        <!-- Sidebar -->
        <aside class="w-full sm:w-64 h-screen bg-[#CBD5E1] flex flex-col items-center py-6 px-4 relative">

            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('asset/logoTelkomHeader.png') }}" alt="Logo Perusahaan" class="w-36 mx-auto">
            </div>

            <!-- Avatar -->
            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Greeting -->
            <h2 class="text-md font-semibold text-gray-800 mb-6">Hi, {{ $user->name ?? 'Project Team' }}!</h2>

            <!-- Search -->
            <div class="w-full mb-6 relative">
                <span class="absolute inset-y-0 left-3 flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                <input type="text" placeholder="Search for..." id="sidebarSearchInput"
                    class="pl-10 pr-4 py-2 w-full rounded-md bg-white text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 border border-gray-300">
            </div>

            <!-- Navigation -->
            <nav class="w-full mb-6">
                <ul class="space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center px-4 py-3 bg-white rounded-md text-gray-800 font-medium hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m2 2h-2v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6H3z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Spacer agar tombol logout tetap di bawah -->
            <div class="flex-grow"></div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="w-full px-4">
                @csrf
                <button type="submit"
                    class="w-full bg-gradient-to-r from-orange-400 to-orange-600 hover:from-orange-500 hover:to-orange-700 text-white font-bold py-2 rounded-full shadow-md transition">
                    Log Out
                </button>
            </form>
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
                        <a href="#" data-tab="overview"
                            class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-active">
                            Overview
                        </a>
                        <a href="#" data-tab="on-hand"
                            class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-inactive hover:text-gray-700 hover:border-gray-300">
                            Project On Hand
                        </a>
                        <a href="#" data-tab="planning"
                            class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-inactive hover:text-gray-700 hover:border-gray-300">
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
        document.addEventListener('DOMContentLoaded', function() {
            // --- FUNGSI SEARCH ---
            const searchInput = document.getElementById('searchInput');
            const navItems = document.querySelectorAll('#mainNav .nav-item');

            searchInput.addEventListener('input', function(e) {
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
                tab.addEventListener('click', function(e) {
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
                    const targetContent = document.querySelector(
                        `[data-tab-content="${this.dataset.tab}"]`);
                    if (targetContent) {
                        targetContent.classList.remove('hidden');
                    }
                });
            });
        });
    </script>

</body>

</html>
