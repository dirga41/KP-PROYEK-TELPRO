<!-- Content Panel: Overview -->
<div id="overview-content" data-tab-content="overview" class="tab-content">
    
    <!-- Baris Atas: Revenue & Top Tenant -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        <!-- Kartu: Jumlah Revenue Per-Segment -->
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Jumlah Revenue Per-Segment</h3>
            @if(isset($segmentData) && $segmentData->isNotEmpty())
                <div class="flex items-center justify-center space-x-6">
                    <!-- Donut Chart Dinamis -->
                    <div class="relative w-40 h-40">
                        <svg class="w-full h-full" viewBox="0 0 36 36" transform="rotate(-90)">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#e5e7eb" stroke-width="4" />
                            
                            @php $offset = 0; @endphp
                            @foreach ($segmentData as $segment)
                                <path class="{{ $segment['color'] }}"
                                      stroke="currentColor" stroke-width="4" fill="none"
                                      stroke-dasharray="{{ $segment['percentage'] }}, 100" 
                                      stroke-dashoffset="-{{ $offset }}"
                                      d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                @php $offset += $segment['percentage']; @endphp
                            @endforeach
                        </svg>
                    </div>
                    <!-- Legenda Dinamis -->
                    <div class="text-sm text-gray-600">
                        <ul>
                            @foreach ($segmentData as $segment)
                                <li class="flex items-center mb-2">
                                    <span class="w-3 h-3 rounded-full {{ str_replace('text-', 'bg-', $segment['color']) }} mr-2"></span>
                                    <span>{{ $segment['name'] }} ({{ $segment['percentage'] }}%)</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @else
                <div class="text-center py-10 text-gray-500">Data segment tidak tersedia.</div>
            @endif
        </div>

        <!-- Kartu: Top 10 Revenue Tenant -->
        <div class="lg:col-span-3 bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Top 10 Revenue Tenant</h3>
            <div class="flex flex-col">
                <div class="flex bg-orange-500 text-white font-bold p-2 rounded-t-lg">
                    <div class="w-1/12 text-center">No</div>
                    <div class="w-7/12 pl-2">Tenant</div>
                    <div class="w-4/12 text-right pr-4">Nilai Kontrak</div>
                </div>
                <div class="max-h-48 overflow-y-auto">
                    @forelse ($topRevenueTenants ?? [] as $index => $tenant)
                        <div class="flex items-center p-2 border-b border-gray-200 hover:bg-gray-50">
                            <div class="w-1/12 text-center text-gray-600">{{ $index + 1 }}.</div>
                            <div class="w-7/12 pl-2 font-medium text-gray-800">{{ $tenant->name }}</div>
                            <div class="w-4/12 text-right pr-4 text-gray-700">Rp. {{ number_format($tenant->value, 0, ',', '.') }}</div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">Data tenant tidak tersedia.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- Baris Bawah: Kontrak Akan Berakhir -->
    <div class="mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Top 10 Kontrak yang Akan Berakhir</h3>
             <div class="flex flex-col">
                <div class="flex bg-orange-500 text-white font-bold p-2 rounded-t-lg">
                    <div class="w-1/12 text-center">No</div>
                    <div class="w-7/12 pl-2">Tenant</div>
                    <div class="w-4/12 text-center">Tanggal Akhir</div>
                </div>
                <div class="max-h-48 overflow-y-auto">
                     @forelse ($expiringContracts ?? [] as $index => $contract)
                        <div class="flex items-center p-2 border-b border-gray-200 hover:bg-gray-50">
                            <div class="w-1/12 text-center text-gray-600">{{ $index + 1 }}.</div>
                            <div class="w-7/12 pl-2 font-medium text-gray-800">{{ $contract->tenant_name }}</div>
                            <div class="w-4/12 text-center text-gray-700">{{ $contract->end_date->format('d-m-Y') }}</div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">Tidak ada kontrak yang akan berakhir.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
