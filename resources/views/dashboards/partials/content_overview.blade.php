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
        
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-center">
            <div class="grid grid-cols-3 gap-x-4">
                {{-- Headers --}}
                <div class="p-2 text-center text-white font-bold bg-gradient-to-r from-[#FD8E01] to-[#B23902] rounded-lg">Kategori</div>
                <div class="p-2 text-center text-white font-bold bg-gradient-to-r from-[#FD8E01] to-[#B23902] rounded-lg">Jumlah Project</div>
                <div class="p-2 text-center text-white font-bold bg-gradient-to-r from-[#FD8E01] to-[#B23902] rounded-lg">Nilai</div>

                {{-- Row On Hand --}}
                <div class="py-3 px-2 font-medium text-gray-700">On Hand</div>
                <div class="py-3 px-2 text-center text-gray-700">{{ $projectOnHandCount }} Project</div>
                <div class="py-3 px-2 text-right font-mono text-gray-700">Rp {{ number_format($projectOnHandValue, 0, ',', '.') }}</div>

                {{-- Row Planning --}}
                <div class="py-3 px-2 font-medium text-gray-700">Planning</div>
                <div class="py-3 px-2 text-center text-gray-700">{{ $projectPlanningCount }} Rencana</div>
                <div class="py-3 px-2 text-right font-mono text-gray-700">Rp {{ number_format($projectPlanningValue, 0, ',', '.') }}</div>

                {{-- Row Total --}}
                <div class="py-3 px-2 font-bold text-gray-800 border-t-2 border-gray-200">Total</div>
                <div class="py-3 px-2 text-center font-bold text-gray-800 border-t-2 border-gray-200">{{ $projectOnHandCount + $projectPlanningCount }} Project</div>
                <div class="py-3 px-2 text-right font-bold font-mono text-gray-800 border-t-2 border-gray-200">Rp {{ number_format($projectOnHandValue + $projectPlanningValue, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="font-semibold text-gray-800 mb-4">Perbandingan Nilai (On Hand vs Planning)</h3>
            {{-- Elemen Canvas untuk Chart --}}
            <div class="relative mx-auto" style="max-width: 280px; max-height: 280px;">
                <canvas id="valueComparisonChart"
                    data-on-hand-value="{{ $projectOnHandValue }}"
                    data-planning-value="{{ $projectPlanningValue }}">
                </canvas>
            </div>
            {{-- Legend Kustom --}}
            <div id="valueChartLegend" class="mt-4 space-y-2 text-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="inline-block w-3 h-3 mr-2 rounded-full" style="background-color: #F7C59F;"></span>
                        <span class="text-gray-600">On Hand</span>
                    </div>
                    <span class="font-semibold font-mono">Rp {{ number_format($projectOnHandValue, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <span class="inline-block w-3 h-3 mr-2 rounded-full" style="background-color: #D35400;"></span>
                        <span class="text-gray-600">Planning</span>
                    </div>
                    <span class="font-semibold font-mono">Rp {{ number_format($projectPlanningValue, 0, ',', '.') }}</span>
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