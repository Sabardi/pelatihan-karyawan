<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Master Data Pelatihan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

              <a href="{{ route('hrd.trainings.create') }}" class="mb-4 inline-block bg-blue-500 text-black px-4 py-2 rounded">Tambah Pelatihan</a>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Nama Pelatihan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Instruktur</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Metode Pelaksanaan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jadwal</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Kuota</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trainings as $training)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 font-medium">{{ $training->nama_pelatihan }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $training->instruktur }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $training->metode_pelaksanaan }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ \Carbon\Carbon::parse($training->tanggal_mulai)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($training->tanggal_selesai)->format('d M Y') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $training->kuota }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <span class="px-2 py-1 text-xs rounded text-black {{ $training->status_pendaftaran == 'dibuka' ? 'bg-green-800' : 'bg-red-500' }}">
                                        {{ strtoupper($training->status_pendaftaran) }}
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('hrd.trainings.edit', $training->id) }}" class="text-yellow-500">Edit</a> |

                                    <form action="{{ route('hrd.trainings.destroy', $training->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data pelatihan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Belum ada data pelatihan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
