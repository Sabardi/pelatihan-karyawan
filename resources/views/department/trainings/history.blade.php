<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pengajuan Pelatihan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Pengajuan Karyawan</h3>
                    <a href="{{ route('department.trainings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 transition text-sm">
                        + Tambah Pengajuan Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Pengajuan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nama Karyawan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Pelatihan</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Status Approval</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Catatan HRD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requests as $req)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $req->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="font-medium text-gray-900">{{ $req->employee->nama }}</span><br>
                                    <span class="text-xs text-gray-500">NIK: {{ $req->employee->nik }}</span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $req->training->nama_pelatihan }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    @if($req->status == 'pending')
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800 font-semibold">MENUNGGU</span>
                                    @elseif($req->status == 'disetujui' || $req->status == 'approved')
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800 font-semibold">DISETUJUI</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800 font-semibold">DITOLAK</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">
                                    {{ $req->catatan_admin ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    Anda belum pernah membuat pengajuan pelatihan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
