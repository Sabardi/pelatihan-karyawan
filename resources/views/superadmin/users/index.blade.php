<x-app-layout>
    <x-slot name="header">Daftar Pengguna (Akun)</x-slot>

    <div class="w-full space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Pengguna</h2>
                <p class="text-sm text-slate-500 mt-2 font-medium">Kelola akun pengguna, hak akses, dan penempatan departemen.</p>
            </div>
            <a href="{{ route('superadmin.users.create') }}" class="flex items-center gap-2 px-6 py-3 bg-slate-800 text-white text-sm font-bold rounded-xl shadow-lg hover:bg-slate-900 transition">
                <i class="ph-bold ph-user-plus text-lg"></i>
                Tambah User Baru
            </a>
        </div>

        <div class="bg-white rounded-[32px] p-8 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100">

            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-sm font-bold">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-widest border-b border-slate-100">
                            <th class="pb-4 px-4">Nama</th>
                            <th class="pb-4 px-4">Email</th>
                            <th class="pb-4 px-4 text-center">Role</th>
                            <th class="pb-4 px-4">Departemen</th>
                            <th class="pb-4 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-5 px-4 font-bold text-slate-800">{{ $user->name }}</td>
                            <td class="py-5 px-4 text-slate-600 text-sm">{{ $user->email }}</td>
                            <td class="py-5 px-4 text-center">
                                @php
                                    $roleClasses = [
                                        'superadmin' => 'bg-slate-800 text-white',
                                        'hrd'        => 'bg-blue-50 text-blue-600 border border-blue-200',
                                        'departemen' => 'bg-purple-50 text-purple-600 border border-purple-200'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $roleClasses[$user->role] ?? 'bg-slate-100' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="py-5 px-4 text-slate-600 text-sm">
                                {{ $user->department ? $user->department->nama_departemen : '-' }}
                            </td>
                            <td class="py-5 px-4">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('superadmin.users.edit', $user->id) }}" class="text-amber-600 hover:text-amber-700 font-bold text-xs flex items-center gap-1">
                                        <i class="ph-bold ph-pencil-simple"></i> Edit
                                    </a>
                                    <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
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
                            <td colspan="5" class="py-10 text-center text-slate-400 font-medium">Belum ada pengguna terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
