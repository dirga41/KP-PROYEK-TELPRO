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

        .tab-active {
            border-bottom: 2px solid #DC2626;
            color: #1F2937;
        }

        .tab-inactive {
            border-bottom: 2px solid transparent;
            color: #6B7280;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="flex h-screen bg-white">
        
        <!-- 1. Memanggil Sidebar -->
        @include('dashboards.partials.sidebar')

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            
            <!-- 2. Memanggil Header -->
            @include('dashboards.partials.header')

            <!-- Content Area -->
            <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
                
                <!-- Overview Content -->
                <div id="overview-content" data-tab-content="overview" class="tab-content">
                    <p class="text-gray-600">Konten untuk tab "Overview" akan ditampilkan di sini.</p>
                </div>

                <!-- 3. Memanggil Konten Tab "On Hand" -->
                @include('dashboards.partials.content_on_hand')

                <!-- 4. Memanggil Konten Tab "Planning" -->
                @include('dashboards.partials.content_planning')

                <!-- 5. Memanggil Konten Tab "RKAP VS Realisasi -->
                 @include('dashboards.partials.content_rkap_vs_realisasi')

            </div>
        </main>
    </div>

    <!-- 5. Memanggil Semua Modal untuk Project -->
    @include('dashboards.partials.modals_project')

    <!-- 6. Memanggil Semua Modal untuk Project Plan -->
    @include('dashboards.partials.modals_plan')
    
    <!-- 7. Memanggil Semua Modal untuk Project Plan -->
    @include('dashboards.partials.modals_rkap')

    <!-- 8. Memanggil Semua Kode JavaScript -->
    @include('dashboards.partials.scripts')

</body>
</html>
