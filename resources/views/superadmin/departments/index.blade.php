<x-app-layout>
    <x-slot name="header">Master Data Departemen</x-slot>

    <div class="w-full space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Departemen</h2>
                <p class="text-sm text-slate-500 mt-2 font-medium">Kelola data struktur organisasi departemen perusahaan.</p>
            </div>
            <a href="{{ route('superadmin.departments.create') }}" class="flex items-center gap-2 px-6 py-3 bg-slate-800 text-white text-sm font-bold rounded-xl shadow-lg hover:bg-slate-900 transition">
                <i class="ph-bold ph-plus text-lg"></i>
                Tambah Departemen
            </a>
        </div>

        <div class="bg-white rounded-[32px] p-8 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100">

            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-widest border-b border-slate-100">
                            <th class="pb-4 px-4">No</th>
                            <th class="pb-4 px-4">Nama Departemen</th>
                            <th class="pb-4 px-4">Deskripsi</th>
                            <th class="pb-4 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($departments as $index => $dept)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-5 px-4 text-slate-500 font-medium">{{ $index + 1 }}</td>
                            <td class="py-5 px-4 font-bold text-slate-800">{{ $dept->nama_departemen }}</td>
                            <td class="py-5 px-4 text-slate-600 text-sm">{{ $dept->deskripsi ?? '-' }}</td>
                            <td class="py-5 px-4">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('superadmin.departments.edit', $dept->id) }}" class="text-amber-600 hover:text-amber-700 font-bold text-xs flex items-center gap-1">
                                        <i class="ph-bold ph-pencil-simple"></i> Edit
                                    </a>
                                    <form action="{{ route('superadmin.departments.destroy', $dept->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus departemen ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-700 font-bold text-xs flex items-center gap-1">
                                            <i class="ph-bold ph-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-400 font-medium">Belum ada departemen yang terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
