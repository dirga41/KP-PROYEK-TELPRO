<!-- Sidebar -->
<aside class="w-64 flex flex-col p-6 border-r border-gray-200 bg-white">
    <!-- Logo -->
    <div class="mb-8">
        <img src="https://placehold.co/150x40/E53E3E/FFFFFF?text=Telkom+Property" alt="Logo Perusahaan" class="h-8 w-auto">
    </div>

    <!-- User Profile -->
    <div class="flex flex-col items-center text-center mb-8">
        <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
        </div>
        <h2 class="text-lg font-semibold text-gray-800">Hi, {{ $user->name ?? 'User' }}!</h2>
    </div>

    <!-- Search Bar -->
    <div class="relative mb-6">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </span>
        <input id="sidebarSearchInput" type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Search menu...">
    </div>

    <!-- Navigation -->
    <nav id="mainNav" class="flex-grow">
        <ul>
            {{-- Tautan ini sudah benar, mengarah ke halaman utama dasbor marketing (kontrak) --}}
            <li class="nav-item mb-2">
                <a href="{{ route('dashboard.marketing') }}" class="flex items-center p-3 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('dashboard.marketing') ? 'bg-red-100 text-red-700 font-bold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Contract
                </a>
            </li>
            {{-- PERUBAHAN: Tautan ke halaman Monitoring Asset di dalam dasbor marketing --}}
            <li class="nav-item mb-2">
                <a href="{{ route('dashboard.marketing.asset') }}" class="flex items-center p-3 text-gray-600 hover:bg-gray-100 rounded-lg {{ request()->routeIs('dashboard.asset') ? 'bg-red-100 text-red-700 font-bold' : '' }}">
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
