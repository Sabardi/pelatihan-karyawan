{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Peserta Pelatihan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Nama Peserta</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Pelatihan</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Status Saat Ini</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($participants as $p)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="font-bold text-gray-900">{{ $p->employee->nama }}</span><br>
                                    <span class="text-xs text-gray-500">NIK: {{ $p->employee->nik }}</span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="font-medium text-blue-700">{{ $p->training->nama_pelatihan }}</span><br>
                                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($p->training->tanggal_mulai)->format('d M Y') }}</span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    @if($p->status_peserta == 'disetujui')
                                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800 font-bold">MENUNGGU MULAI</span>
                                    @elseif($p->status_peserta == 'sedang_pelatihan')
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800 font-bold">SEDANG PELATIHAN</span>
                                    @elseif($p->status_peserta == 'selesai')
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800 font-bold">SELESAI</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-800 font-bold">{{ strtoupper($p->status_peserta) }}</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <form action="{{ route('hrd.participants.updateStatus', $p->id) }}" method="POST" class="inline-flex items-center space-x-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status_peserta" class="text-sm border-gray-300 rounded-md shadow-sm" required>
                                            <option value="disetujui" {{ $p->status_peserta == 'disetujui' ? 'selected' : '' }}>Menunggu Mulai</option>
                                            <option value="sedang_pelatihan" {{ $p->status_peserta == 'sedang_pelatihan' ? 'selected' : '' }}>Sedang Pelatihan</option>
                                            <option value="selesai" {{ $p->status_peserta == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="bg-gray-800 text-white text-sm px-3 py-2 rounded shadow hover:bg-gray-700">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    Belum ada peserta pelatihan yang terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout> --}}


<x-app-layout>
    <x-slot name="header">Manajemen Peserta Pelatihan</x-slot>

    <div class="w-full space-y-6">
        <!-- Page Title -->
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Peserta</h2>
            <p class="text-sm text-slate-500 mt-2 font-medium">Pantau status partisipasi dan perbarui progress pelatihan karyawan.</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-[32px] p-8 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100">

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-widest border-b border-slate-100">
                            <th class="pb-4 px-4">Nama Peserta</th>
                            <th class="pb-4 px-4">Pelatihan</th>
                            <th class="pb-4 px-4 text-center">Status</th>
                            <th class="pb-4 px-4 text-center">Update Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($participants as $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-5 px-4">
                                <div class="font-bold text-slate-800">{{ $p->employee->nama }}</div>
                                <div class="text-[11px] text-slate-400 uppercase tracking-wide">NIK: {{ $p->employee->nik }}</div>
                            </td>
                            <td class="py-5 px-4">
                                <div class="font-bold text-slate-700 text-sm">{{ $p->training->nama_pelatihan }}</div>
                                <div class="text-[11px] text-slate-400 font-medium">Mulai: {{ \Carbon\Carbon::parse($p->training->tanggal_mulai)->format('d M Y') }}</div>
                            </td>
                            <td class="py-5 px-4 text-center">
                                @php
                                    $statusClasses = [
                                        'disetujui'        => 'bg-blue-50 text-blue-600 border border-blue-200',
                                        'sedang_pelatihan' => 'bg-amber-50 text-amber-600 border border-amber-200',
                                        'selesai'          => 'bg-emerald-50 text-emerald-600 border border-emerald-200'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $statusClasses[$p->status_peserta] ?? 'bg-slate-100' }}">
                                    {{ str_replace('_', ' ', $p->status_peserta) }}
                                </span>
                            </td>
                            <td class="py-5 px-4">
                                <form action="{{ route('hrd.participants.updateStatus', $p->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                    @csrf @method('PATCH')
                                    <select name="status_peserta" class="text-[11px] font-bold border-2 border-slate-100 rounded-xl px-3 py-2 bg-slate-50 focus:border-blue-400 outline-none cursor-pointer">
                                        <option value="disetujui" {{ $p->status_peserta == 'disetujui' ? 'selected' : '' }}>Menunggu Mulai</option>
                                        <option value="sedang_pelatihan" {{ $p->status_peserta == 'sedang_pelatihan' ? 'selected' : '' }}>Sedang Pelatihan</option>
                                        <option value="selesai" {{ $p->status_peserta == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="px-3 py-2 bg-slate-800 text-white text-[11px] font-bold rounded-xl hover:bg-slate-900 transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-400 font-medium">Belum ada peserta pelatihan yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
