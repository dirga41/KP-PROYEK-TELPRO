<div id="overview-content" data-tab-content="overview" class="tab-content">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card RKAP Q1 -->
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col">
            <h3 class="text-sm font-semibold text-gray-500">RKAP Q1</h3>
            <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($rkapSummary['Q1'] ?? 0, 0, ',', '.') }}</p>
        </div>
        <!-- Card RKAP Q2 -->
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col">
            <h3 class="text-sm font-semibold text-gray-500">RKAP Q2</h3>
            <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($rkapSummary['Q2'] ?? 0, 0, ',', '.') }}</p>
        </div>
        <!-- Card RKAP Q3 -->
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col">
            <h3 class="text-sm font-semibold text-gray-500">RKAP Q3</h3>
            <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($rkapSummary['Q3'] ?? 0, 0, ',', '.') }}</p>
        </div>
        <!-- Card RKAP Q4 -->
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col">
            <h3 class="text-sm font-semibold text-gray-500">RKAP Q4</h3>
            <p class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($rkapSummary['Q4'] ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
         <!-- Card Jumlah Project -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4">Jumlah Project</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Project On Hand</span>
                    <span class="font-bold text-lg text-blue-600">{{ $projectOnHandCount }} Proyek</span>
                </div>
                 <div class="flex justify-between items-center">
                    <span class="text-gray-600">Project Planning</span>
                    <span class="font-bold text-lg text-purple-600">{{ $projectPlanningCount }} Rencana</span>
                </div>
            </div>
        </div>
        <!-- Card Nilai Project -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4">Total Nilai Project</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">On Hand (Kontrak)</span>
                    <span class="font-bold text-lg text-green-600">Rp {{ number_format($projectOnHandValue, 0, ',', '.') }}</span>
                </div>
                 <div class="flex justify-between items-center">
                    <span class="text-gray-600">Planning (Estimasi)</span>
                    <span class="font-bold text-lg text-yellow-600">Rp {{ number_format($projectPlanningValue, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="font-semibold text-gray-800 mb-4">Update Progress per Segment</h3>
        <div>
            <canvas id="projectStatusChart" data-chart-data="{{ json_encode($projectStatusBySegment) }}"></canvas>
        </div>
    </div>
</div>
