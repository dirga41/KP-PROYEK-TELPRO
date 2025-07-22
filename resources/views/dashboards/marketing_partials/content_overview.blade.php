<div id="overview-content" data-tab-content="overview" class="tab-content">

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Jumlah Revenue Per-Segment</h3>

            @if(isset($segmentData) && $segmentData->isNotEmpty())
            <div class="flex items-center justify-center space-x-6">
                <div id="donutChartContainer"
                     class="relative w-2/5"
                     data-segments="{{ json_encode($segmentData) }}">

                    <svg id="donutChartSvg" class="w-full h-full" viewBox="0 0 36 36" transform="rotate(-90)">
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                              fill="none" stroke="#e5e7eb" stroke-width="4" />
                    </svg>
                </div>

                <div class="text-sm text-gray-600">
                    <ul id="donutChartLegend">
                        </ul>
                </div>
            </div>
            @else
            <div class="text-center py-10 text-gray-500">Data segment tidak tersedia.</div>
            @endif
        </div>

        <div class="lg:col-span-3 bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Top 10 Revenue Tenant</h3>

            <table class="w-full border-separate" style="border-spacing: 8px 0;">
                <thead>
                    <tr>
                        <th class="w-1/12 py-3 px-2 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold">No</th>
                        <th class="w-7/12 py-3 px-4 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold">Tenant</th>
                        <th class="w-4/12 py-3 px-4 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold">Nilai Kontrak</th>
                    </tr>
                </thead>
            </table>

            <div class="max-h-48 overflow-y-auto mt-2">
                <table class="w-full border-separate" style="border-spacing: 0 8px;">
                    <tbody>
                        @forelse ($topRevenueTenants ?? [] as $index => $tenant)
                        <tr class="bg-gray-50 rounded-lg">
                            <td class="w-1/12 py-2 px-2 text-center text-gray-600">{{ $loop->iteration }}.</td>
                            <td class="w-7/12 py-2 px-4 font-medium text-gray-800">{{ $tenant->name }}</td>
                            <td class="w-4/12 py-2 px-4 text-right text-gray-700">Rp. {{ number_format($tenant->value, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">Data tenant tidak tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Top 10 Kontrak yang Akan Berakhir</h3>

            <table class="w-full border-separate" style="border-spacing: 8px 0;">
                <thead>
                    <tr>
                        <th class="w-1/12 py-3 px-2 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold">No</th>
                        <th class="w-7/12 py-3 px-4 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold">Tenant</th>
                        <th class="w-4/12 py-3 px-4 text-center rounded-lg bg-gradient-to-r from-[#FD8E01] to-[#B23902] text-white font-bold">Tanggal Akhir</th>
                    </tr>
                </thead>
            </table>

            <div class="max-h-48 overflow-y-auto mt-2">
                <table class="w-full border-separate" style="border-spacing: 0 8px;">
                    <tbody>
                        @forelse ($expiringContracts ?? [] as $index => $contract)
                        <tr class="bg-gray-50 rounded-lg">
                            <td class="w-1/12 py-2 px-2 text-center text-gray-600">{{ $loop->iteration }}.</td>
                            <td class="w-7/12 py-2 px-4 font-medium text-gray-800">{{ $contract->tenant_name }}</td>
                            <td class="w-4/12 py-2 px-4 text-center text-gray-700">{{ \Carbon\Carbon::parse($contract->end_date)->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">Tidak ada kontrak yang akan berakhir.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>