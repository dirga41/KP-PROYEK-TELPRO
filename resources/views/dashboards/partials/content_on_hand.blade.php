<div id="on-hand-content" data-tab-content="on-hand" class="tab-content hidden">
    <div class="flex justify-end items-center mb-4">
        <div class="relative"><input id="projectTableSearch" type="text" placeholder="Search"
                class="border rounded-lg py-2 px-8"><span
                class="absolute left-2 top-2.5 text-gray-400"><svg class="w-5 h-5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg></span></div>
        <button id="exportButton" class="ml-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">Export</button>
        <button id="openInputModal"
            class="ml-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">Input</button>
    </div>
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4"
        role="alert"><span class="block sm:inline">{{ session('success') }}</span></div>
    @endif
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left"><input type="checkbox" id="selectAllCheckbox">
                    </th>
                    <th class="py-3 px-6 text-left">Segment</th>
                    <th class="py-3 px-6 text-left">Project</th>
                    <th class="py-3 px-6 text-left">No Kontrak</th>
                    <th class="py-3 px-6 text-left">Tgl Kontrak</th>
                    <th class="py-3 px-6 text-left">Nilai</th>
                    <th class="py-3 px-6 text-left">TOC</th>
                    <th class="py-3 px-6 text-left">Area</th>
                    <th class="py-3 px-6 text-left">Mitra</th>
                    <th class="py-3 px-6 text-center">Status Progress</th>
                    <th class="py-3 px-6 text-left">Jenis Pengadaan</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="projectTableBody" class="text-gray-700 text-sm">
                @forelse ($projects as $project)
                <tr class="project-row border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left"><input type="checkbox" class="row-checkbox" data-id="{{ $project->id }}">
                    </td>
                    <td class="py-3 px-6 text-left">{{ $project->segment }}</td>
                    <td class="py-3 px-6 text-left font-medium">{{ $project->project }}</td>
                    <td class="py-3 px-6 text-left">{{ $project->no_kontrak }}</td>
                    <td class="py-3 px-6 text-left">
                        {{ $project->tanggal_kontrak->format('d M Y') }}
                    </td>
                    <td class="py-3 px-6 text-left">Rp
                        {{ number_format($project->nilai_kontrak, 0, ',', '.') }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $project->toc ? $project->toc->format('d M Y') : '-' }}
                    </td>
                    <td class="py-3 px-6 text-left">{{ $project->area }}</td>
                    <td class="py-3 px-6 text-left">{{ $project->mitra ?? '-' }}</td>
                    <td class="py-3 px-6 text-center">
                        @if ($project->status_progres == 'ongoing')
                        <span
                            class="bg-blue-200 text-blue-800 py-1 px-3 rounded-full text-xs">On
                            Going</span>
                        @elseif($project->status_progres == 'closed')
                        <span
                            class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Closed</span>
                        @elseif($project->status_progres == 'closed adm')
                        <span
                            class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Closed
                            Adm</span>@else<span
                            class="bg-gray-200 text-gray-800 py-1 px-3 rounded-full text-xs">Not
                            Started</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-left">{{ $project->jenis_pengadaan ?? '-' }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <button data-id="{{ $project->id }}"
                                class="view-btn w-8 h-8 rounded-full flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white mr-2"
                                title="View Details"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg></button>
                            <button data-id="{{ $project->id }}"
                                class="edit-btn w-8 h-8 rounded-full flex items-center justify-center bg-yellow-400 hover:bg-yellow-500 text-white mr-2"
                                title="Edit"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.536l12.232-12.232z" />
                                </svg></button>
                            <button data-id="{{ $project->id }}"
                                class="delete-btn w-8 h-8 rounded-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white"
                                title="Hapus"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center py-6">Belum ada data proyek.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
