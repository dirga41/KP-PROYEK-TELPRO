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
            border-bottom: 2px solid #3B82F6; /* blue-500 */
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
                    <a href="#" class="flex items-center p-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Contract
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="flex items-center p-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        Monitoring Asset
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
                    <a href="#" data-tab="overview" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-active">
                        Overview
                    </a>
                    <a href="#" data-tab="contract" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-inactive hover:text-gray-700 hover:border-gray-300">
                        Database Contract
                    </a>
                </nav>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
            <!-- Content Panels -->
            <div id="overview-content" data-tab-content="overview" class="tab-content">
                <p class="text-gray-600">Konten untuk "Overview" akan ditampilkan di sini.</p>
            </div>
            <div id="contract-content" data-tab-content="contract" class="tab-content hidden">
                <p class="text-gray-600">Konten untuk "Database Contract" akan ditampilkan di sini.</p>
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

</body>
</html>
