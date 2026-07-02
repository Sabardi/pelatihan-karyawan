<x-app-layout>
    <x-slot name="header">Daftar Pelatihan Tersedia</x-slot>

    <div class="w-full space-y-6">
        <!-- Page Title -->
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Katalog Pelatihan</h2>
            <p class="text-sm text-slate-500 mt-2 font-medium">Pilih program pelatihan yang tersedia untuk diajukan kepada karyawan Anda.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($trainings as $training)
                @php
                    $badgeColor = match($training->metode_pelaksanaan) {
                        'ONLINE' => 'bg-blue-50 text-blue-600',
                        'HYBRID' => 'bg-purple-50 text-purple-600',
                        default => 'bg-emerald-50 text-emerald-600',
                    };
                @endphp

                <div class="bg-white rounded-[32px] p-6 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100 flex flex-col hover:shadow-lg transition-all duration-300">
                    <!-- Header Card -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 {{ $badgeColor }} text-[10px] font-bold uppercase tracking-wider rounded-md">
                            {{ $training->metode_pelaksanaan }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-400">KUOTA: {{ $training->kuota }}</span>
                    </div>

                    <h4 class="font-extrabold text-lg text-slate-800 mb-4 leading-snug">{{ $training->nama_pelatihan }}</h4>

                    <!-- Info List -->
                    <div class="space-y-3 mb-8 flex-1">
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                            <i class="ph-fill ph-user-circle text-slate-400 text-lg"></i>
                            <span class="font-medium">{{ $training->instruktur ?? 'Belum ditentukan' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                            <i class="ph-fill ph-calendar-blank text-slate-400 text-lg"></i>
                            <span class="font-medium">
                                {{ \Carbon\Carbon::parse($training->tanggal_mulai)->format('d M') }} -
                                {{ \Carbon\Carbon::parse($training->tanggal_selesai)->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Button -->
                    <a href="{{ route('department.trainings.request', $training->id) }}"
                        class="w-full text-center bg-slate-800 text-white font-bold text-sm py-3 rounded-xl hover:bg-slate-900 transition shadow-lg hover:shadow-xl">
                        Ajukan Karyawan
                    </a>
                </div>
            @empty
                <div class="col-span-full p-12 bg-white rounded-[32px] border border-slate-100 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4">
                        <i class="ph-fill ph-graduation-cap text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Tidak ada pelatihan</h3>
                    <p class="text-sm text-slate-500">Saat ini belum ada program pelatihan yang dibuka.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
