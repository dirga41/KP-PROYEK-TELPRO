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
