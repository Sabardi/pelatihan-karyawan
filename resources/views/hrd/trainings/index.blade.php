<x-app-layout>
    <x-slot name="header">
        Katalog Pelatihan
    </x-slot>

    <style>
        .ticket-divider {
            position: relative;
        }

        .ticket-divider::before,
        .ticket-divider::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background-color: #f3f4f6; /* Menyesuaikan dengan warna background Breeze */
            border-radius: 50%;
            right: -12px;
            z-index: 10;
        }

        .ticket-divider::before {
            top: -24px;
        }

        .ticket-divider::after {
            bottom: -24px;
        }

        @media (max-width: 640px) {
            .ticket-divider {
                border-right: none !important;
                border-bottom: 2px dashed #f1f5f9;
            }

            .ticket-divider::before,
            .ticket-divider::after {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
                bottom: -12px;
                top: auto;
            }

            .ticket-divider::before {
                left: -24px;
                transform: none;
            }

            .ticket-divider::after {
                right: -24px;
                left: auto;
                transform: none;
            }
        }
    </style>

    <div class="w-full space-y-6">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Katalog Pelatihan</h2>
                <p class="text-sm text-slate-500 mt-2 font-medium">Kelola dan pantau program pengembangan kompetensi karyawan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('hrd.trainings.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl shadow-sm hover:bg-blue-700 transition-colors">
                    <i class="ph-bold ph-plus text-lg"></i>
                    Tambah Pelatihan
                </a>
                <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">
                    <i class="ph-bold ph-faders text-lg"></i>
                    Filter
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 pb-20">

            @forelse ($trainings as $training)
                @php
                    // Logika warna badge berdasarkan metode pelaksanaan
                    $badgeColor = match($training->metode_pelaksanaan) {
                        'ONLINE' => 'bg-blue-50 text-blue-600',
                        'HYBRID' => 'bg-purple-50 text-purple-600',
                        default => 'bg-emerald-50 text-emerald-600',
                    };

                    // PERBAIKAN: Jadikan status_pendaftaran dari database sebagai penentu utama Buka/Tutup
                    $isClosed = strtolower($training->status_pendaftaran) === 'ditutup';
                    $statusText = $isClosed ? 'TUTUP' : 'DIBUKA';
                    $statusColor = $isClosed ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-green-50 text-green-600 border border-green-200';
                @endphp

                <div class="bg-white rounded-[32px] p-6 sm:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col sm:flex-row hover:shadow-[0_12px_40px_rgb(0,0,0,0.08)] transition-all duration-300 border border-slate-100 relative overflow-hidden group">

                    <div class="flex-1 pr-0 sm:pr-8 ticket-divider border-r-2 border-dashed border-slate-200 pb-6 sm:pb-0 mb-6 sm:mb-0">
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <span class="px-3 py-1.5 {{ $statusColor }} text-[10px] font-bold uppercase tracking-wider rounded-md flex items-center gap-1">
                                @if($isClosed)
                                    <i class="ph-bold ph-lock-key"></i>
                                @else
                                    <i class="ph-bold ph-door-open"></i>
                                @endif
                                {{ $statusText }}
                            </span>
                            <span class="px-3 py-1.5 {{ $badgeColor }} text-[10px] font-bold uppercase tracking-wider rounded-md">
                                {{ $training->metode_pelaksanaan }}
                            </span>
                            <span class="text-[11px] font-semibold text-slate-400 ml-auto">#TR-{{ str_pad($training->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <h3 class="text-2xl font-bold text-slate-800 leading-tight mb-3">{{ $training->nama_pelatihan }}</h3>
                        <p class="text-sm text-slate-500 font-medium line-clamp-2 mb-6">
                            {{ $training->deskripsi ?? 'Belum ada deskripsi untuk pelatihan ini.' }}
                        </p>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 text-slate-400"><i class="ph-fill ph-calendar-blank text-xl"></i></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Mulai</p>
                                    <p class="text-sm font-bold text-slate-700 leading-snug">
                                        {{ $training->tanggal_mulai ? \Carbon\Carbon::parse($training->tanggal_mulai)->format('d M Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 text-slate-400"><i class="ph-fill ph-user text-xl"></i></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Instruktur</p>
                                    <p class="text-sm font-bold text-slate-700 leading-snug truncate pr-2">
                                        {{ $training->instruktur ?? 'Belum ditentukan' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full sm:w-48 pl-0 sm:pl-8 flex flex-col justify-center items-center text-center">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Kapasitas</p>
                        <div class="flex items-baseline gap-1 mb-3">
                            <span class="text-3xl font-extrabold text-slate-800">{{ $training->employees->count() }}</span>
                            <span class="text-lg font-bold text-slate-400">/{{ $training->kuota }}</span>
                        </div>

                        <div class="w-full h-1.5 bg-slate-100 rounded-full mb-5 overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full" style="width: 0%"></div>
                        </div>

                        @if($isClosed)
                            <button class="w-full py-2.5 mb-2 rounded-xl bg-slate-100 text-slate-400 font-bold text-sm cursor-not-allowed flex items-center justify-center gap-2">
                                <i class="ph-bold ph-prohibit"></i> Ditutup
                            </button>
                        @else
                            <a href="{{ route('hrd.trainings.show', $training->id) }}" class="w-full mb-2">
                                <button class="w-full py-2.5 rounded-xl border-2 border-blue-600 text-blue-600 font-bold text-sm hover:bg-blue-50 transition-colors flex items-center justify-center gap-2">
                                    Detail <i class="ph-bold ph-arrow-right"></i>
                                </button>
                            </a>
                        @endif

                        <a href="{{ route('hrd.trainings.edit', $training->id) }}" class="w-full">
                            <button class="w-full py-2 rounded-xl text-slate-500 font-bold text-xs hover:bg-amber-50 hover:text-amber-600 transition-colors flex items-center justify-center gap-2">
                                <i class="ph-bold ph-pencil-simple"></i> Edit Pelatihan
                            </button>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center p-12 bg-white rounded-3xl border border-slate-100 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mb-4">
                        <i class="ph-fill ph-graduation-cap text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Pelatihan</h3>
                    <p class="text-slate-500 mb-6 max-w-md">Katalog pelatihan masih kosong. Silakan tambahkan program pelatihan baru untuk karyawan Anda.</p>
                </div>
            @endforelse

        </div>

        <div class="mt-6">
            {{ $trainings->links() }}
        </div>
    </div>
</x-app-layout>
