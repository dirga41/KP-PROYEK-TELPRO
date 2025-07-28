<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Asset Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        .tab-active { border-bottom: 2px solid #EF4444; /* red-500 */ color: #1F2937; /* gray-800 */ }
        .tab-inactive { border-bottom: 2px solid transparent; color: #6B7280; /* gray-500 */ }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex h-screen bg-white">
    
    @include('dashboards.marketing_partials.sidebar')

    <main class="flex-1 flex flex-col overflow-hidden">
        
        @include('dashboards.marketing_partials.header_asset')

        <div class="flex-1 p-6 overflow-y-auto bg-gray-100">
            @include('dashboards.marketing_partials.content_overview_asset')
            @include('dashboards.marketing_partials.content_telkom_asset')
            @include('dashboards.marketing_partials.content_gsd_asset')
        </div>
    </main>
</div>

@include('dashboards.marketing_partials.modals_asset')
@include('dashboards.marketing_partials.modals_gsd')
@include('dashboards.marketing_partials.scripts_asset')

</body>
</html>