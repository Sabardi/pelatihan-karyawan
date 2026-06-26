<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Persetujuan Pengajuan Pelatihan
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
                                <th class="border border-gray-300 px-4 py-2 text-left">Karyawan & Dept</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Pelatihan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Pengaju</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Status Saat Ini</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Aksi / Tindakan HRD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requests as $req)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="font-bold text-gray-900">{{ $req->employee->nama }}</span><br>
                                    <span class="text-xs text-gray-500">NIK: {{ $req->employee->nik }}</span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $req->training->nama_pelatihan }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-sm">
                                    {{ $req->diajukanOleh->name ?? 'Sistem' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    @if($req->status == 'pending')
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800 font-semibold">PENDING</span>
                                    @elseif($req->status == 'approved')
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800 font-semibold">APPROVED</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800 font-semibold">REJECTED</span>
                                    @endif

                                    @if($req->catatan_admin)
                                        <p class="text-xs text-gray-500 italic mt-1">"{{ $req->catatan_admin }}"</p>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if($req->status == 'pending')
                                        <form action="{{ route('hrd.requests.process', $req->id) }}" method="POST" class="space-y-2">
                                            @csrf
                                            @method('PATCH')

                                            <input type="text" name="catatan_admin" placeholder="Tulis catatan (opsional)..." class="w-full text-xs border-gray-300 rounded-md p-1 shadow-sm">

                                            <div class="flex justify-center space-x-2">
                                                <button type="submit" name="status" value="approved" class="bg-green-500 hover:bg-green-600 text-black text-xs px-2 py-1 rounded shadow" onclick="return confirm('Setujui karyawan ini untuk mengikuti pelatihan?')">
                                                    Setujui
                                                </button>
                                                <button type="submit" name="status" value="rejected" class="bg-red-500 hover:bg-red-600 text-black text-xs px-2 py-1 rounded shadow" onclick="return confirm('Tolak pengajuan karyawan ini?')">
                                                    Tolak
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <p class="text-center text-xs text-gray-400 italic">Sudah diproses</p>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    Belum ada pengajuan masuk dari departemen manapun.
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
