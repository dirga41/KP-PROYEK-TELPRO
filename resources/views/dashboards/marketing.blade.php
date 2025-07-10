<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
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
    
    <!-- 1. Memanggil Sidebar -->
    @include('dashboards.marketing_partials.sidebar')

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        
        <!-- 2. Memanggil Header -->
        @include('dashboards.marketing_partials.header')

        <!-- Content Area -->
        <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
            
            <!-- 3. Memanggil Konten Partial -->
            @include('dashboards.marketing_partials.content_overview')
            @include('dashboards.marketing_partials.content_contract')

        </div>
    </main>
</div>

<!-- 4. Memanggil Modal (jika ada) -->
@include('dashboards.marketing_partials.modals_contract')

<!-- 5. Memanggil Scripts -->
@include('dashboards.marketing_partials.scripts')

</body>
</html>
