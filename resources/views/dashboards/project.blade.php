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
        .tab-active { border-bottom: 2px solid #DC2626; color: #1F2937; }
        .tab-inactive { border-bottom: 2px solid transparent; color: #6B7280; }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen bg-white">
    <!-- Sidebar -->
    <aside class="w-64 flex flex-col p-6 border-r border-gray-200">
        <div class="mb-8"><img src="https://placehold.co/150x40/E53E3E/FFFFFF?text=Telkom+Property" alt="Logo Perusahaan" class="h-8 w-auto"></div>
        <div class="flex flex-col items-center text-center mb-8">
            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Hi, {{ $user->name }}!</h2>
        </div>
        <div class="relative mb-6">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3"><svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
            <input id="searchInput" type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Search for...">
        </div>
        <nav id="mainNav" class="flex-grow">
            <ul>
                <li class="nav-item mb-2"><a href="#" class="flex items-center p-3 text-gray-700 bg-red-100 rounded-lg font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>Dashboard</a></li>
            </ul>
        </nav>
        <div class="mt-auto">
             <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Logout</button></form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <div class="mt-4 border-b border-gray-200">
                <nav id="tabs" class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="#" data-tab="overview" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-active">Overview</a>
                    <a href="#" data-tab="on-hand" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-inactive hover:text-gray-700 hover:border-gray-300">Project On Hand</a>
                    <a href="#" data-tab="planning" class="tab-link whitespace-nowrap py-4 px-1 font-semibold text-sm tab-inactive hover:text-gray-700 hover:border-gray-300">Project Planning</a>
                </nav>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
            <div id="overview-content" data-tab-content="overview" class="tab-content"><p class="text-gray-600">Konten untuk tab "Overview" akan ditampilkan di sini.</p></div>
            
            <!-- KONTEN PROJECT ON HAND -->
            <div id="on-hand-content" data-tab-content="on-hand" class="tab-content hidden">
                <!-- Header Tabel -->
                <div class="flex justify-end items-center mb-4">
                    <a href="{{ route('projects.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">Input</a>
                    <div class="relative ml-4">
                        <input type="text" placeholder="Search" class="border rounded-lg py-2 px-4">
                        <span class="absolute right-3 top-2.5 text-gray-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></span>
                    </div>
                </div>

                <!-- Pesan Sukses -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Tabel Data -->
                <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left"><input type="checkbox"></th>
                                <th class="py-3 px-6 text-left">Segment</th>
                                <th class="py-3 px-6 text-left">Area</th>
                                <th class="py-3 px-6 text-left">Project</th>
                                <th class="py-3 px-6 text-left">No Kontrak</th>
                                <th class="py-3 px-6 text-left">Tgl Kontrak</th>
                                <th class="py-3 px-6 text-left">Nilai</th>
                                <th class="py-3 px-6 text-left">TOC</th>
                                <th class="py-3 px-6 text-center">Status Progress</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse ($projects as $project)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left"><input type="checkbox"></td>
                                    <td class="py-3 px-6 text-left">{{ $project->segment }}</td>
                                    <td class="py-3 px-6 text-left">{{ $project->area }}</td>
                                    <td class="py-3 px-6 text-left font-medium">{{ $project->project }}</td>
                                    <td class="py-3 px-6 text-left">{{ $project->no_kontrak }}</td>
                                    <td class="py-3 px-6 text-left">{{ $project->tanggal_kontrak->format('d M Y') }}</td>
                                    <td class="py-3 px-6 text-left">Rp {{ number_format($project->nilai_kontrak, 0, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-left">{{ $project->toc ? $project->toc->format('d M Y') : '-' }}</td>
                                    <td class="py-3 px-6 text-center">
                                        @if($project->status_progres == 'ongoing')
                                            <span class="bg-blue-200 text-blue-800 py-1 px-3 rounded-full text-xs">On Going</span>
                                        @elseif($project->status_progres == 'closed')
                                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Closed</span>
                                        @elseif($project->status_progres == 'closed adm')
                                            <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Closed Adm</span>
                                        @else
                                            <span class="bg-gray-200 text-gray-800 py-1 px-3 rounded-full text-xs">Not Started</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a href="{{ route('projects.edit', $project->id) }}" class="w-8 h-8 rounded-full flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-white mr-2" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536l12.232-12.232z" /></svg>
                                            </a>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus proyek ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-6">Belum ada data proyek. Silakan klik tombol "Input" untuk menambah data baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="planning-content" data-tab-content="planning" class="tab-content hidden"><p class="text-gray-600">Konten untuk tab "Project Planning" akan ditampilkan di sini.</p></div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const navItems = document.querySelectorAll('#mainNav .nav-item');
        searchInput.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            navItems.forEach(item => {
                const itemText = item.textContent.toLowerCase();
                if (itemText.includes(searchTerm)) { item.style.display = 'block'; } else { item.style.display = 'none'; }
            });
        });

        const tabs = document.querySelectorAll('#tabs .tab-link');
        const tabContents = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                tabs.forEach(item => { item.classList.remove('tab-active'); item.classList.add('tab-inactive'); });
                this.classList.remove('tab-inactive'); this.classList.add('tab-active');
                tabContents.forEach(content => { content.classList.add('hidden'); });
                const targetContent = document.querySelector(`[data-tab-content="${this.dataset.tab}"]`);
                if (targetContent) { targetContent.classList.remove('hidden'); }
            });
        });
    });
</script>

</body>
</html>
