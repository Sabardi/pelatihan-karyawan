<x-app-layout>
    <x-slot name="header">
        Detail Pelatihan
    </x-slot>

    <div class="w-full space-y-6">

        <!-- Header & Nav -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <nav class="flex items-center text-sm text-slate-500 font-semibold">
                <a href="{{ route('hrd.trainings.index') }}"
                    class="flex items-center gap-2 hover:text-blue-600 transition">
                    <i class="ph-bold ph-arrow-left text-lg"></i> Kembali ke Katalog
                </a>
            </nav>
            <div class="flex gap-3">
                <a href="{{ route('hrd.trainings.edit', $training->id) }}"
                    class="px-4 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition">
                    Edit Pelatihan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Info Utama -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[32px] p-8 md:p-10 shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3 mb-6">
                        <span
                            class="px-3 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wider rounded-md">
                            {{ $training->metode_pelaksanaan }}
                        </span>
                        <span
                            class="text-xs font-semibold text-slate-400">#TR-{{ str_pad($training->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <h1 class="text-4xl font-extrabold text-slate-900 mb-4">{{ $training->nama_pelatihan }}</h1>
                    <p class="text-slate-600 leading-relaxed text-lg mb-8">{{ $training->deskripsi }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-slate-50 rounded-2xl">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="ph-fill ph-chalkboard-teacher text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">Instruktur</p>
                                <p class="font-bold text-slate-800">{{ $training->instruktur }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="ph-fill ph-map-pin text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">Lokasi / Link
                                </p>
                                <p class="font-bold text-slate-800">{{ $training->lokasi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Sidebar Detail -->
            <div class="space-y-6">
                <div class="bg-white rounded-[32px] p-8 shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-6">Informasi Jadwal</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between py-3 border-b border-slate-50">
                            <span class="text-slate-500 font-medium">Tanggal Mulai</span>
                            <span
                                class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($training->tanggal_mulai)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-slate-50">
                            <span class="text-slate-500 font-medium">Tanggal Selesai</span>
                            <span
                                class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($training->tanggal_selesai)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between py-3">
                            <span class="text-slate-500 font-medium">Kuota Peserta</span>
                            <span class="font-bold text-slate-800">{{ $training->kuota }} Orang</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[32px] p-8 shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 mb-4">Status Pendaftaran</h3>
                    <div
                        class="px-4 py-3 rounded-xl {{ $training->status_pendaftaran == 'dibuka' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }} text-center font-bold uppercase text-sm tracking-wide">
                        {{ $training->status_pendaftaran }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Peserta -->
        <div class="bg-white rounded-[32px] p-8 shadow-sm border border-slate-100">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Peserta Terdaftar ({{ $training->employees->count() }})
            </h3>

            @if ($training->employees->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="text-left text-slate-400 text-xs font-bold uppercase tracking-wider">
                            <tr>
                                <th class="pb-4">Nama</th>
                                <th class="pb-4">NIK</th>
                                <th class="pb-4">Status Peserta</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($training->employees as $peserta)
                                <tr>
                                    <td class="py-4 font-bold text-slate-800">{{ $peserta->nama }}</td>
                                    <td class="py-4 text-slate-600">{{ $peserta->nik }}</td>
                                    <td class="py-4">
                                        <span
                                            class="px-2 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-lg uppercase">
                                            {{ $peserta->pivot->status_peserta ?? 'terdaftar' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-10 text-slate-400">
                    <i class="ph ph-users-three text-4xl mb-3"></i>
                    <p>Belum ada peserta yang terdaftar di pelatihan ini.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
