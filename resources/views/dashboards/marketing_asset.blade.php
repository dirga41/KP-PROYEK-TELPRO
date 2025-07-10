<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Asset - Marketing Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen bg-white">
    
    {{-- 1. Memanggil Sidebar yang sama --}}
    {{-- Logika di dalam file sidebar akan otomatis mengaktifkan tombol "Monitoring Asset" --}}
    {{-- karena halaman ini dimuat dari rute 'dashboard.marketing.asset' --}}
    @include('dashboards.marketing_partials.sidebar', ['user' => $user])

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        
        {{-- 2. Header untuk Halaman Monitoring Asset --}}
        <header class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-3xl font-bold text-gray-800">Monitoring Asset</h1>
            <p class="text-sm text-gray-600 mt-1">Halaman untuk memantau aset marketing.</p>
        </header>

        <!-- Content Area -->
        <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
            
            {{-- 3. Konten untuk Halaman Monitoring Asset --}}
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4">Dalam Pengembangan</h2>
                <p class="text-gray-600">Fitur dan konten untuk halaman monitoring aset akan ditambahkan di sini.</p>
            </div>

        </div>
    </main>
</div>

{{-- Anda bisa menambahkan modal khusus untuk halaman ini di sini jika diperlukan --}}

{{-- Anda bisa menambahkan skrip khusus untuk halaman ini di sini jika diperlukan --}}

</body>
</html>
