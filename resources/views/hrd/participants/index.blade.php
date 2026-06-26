<x-app-layout>
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
</x-app-layout>
