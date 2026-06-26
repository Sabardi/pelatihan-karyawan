<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pelatihan Tersedia
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-lg font-bold mb-4 text-gray-700">Silakan pilih pelatihan untuk karyawan Anda:</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($trainings as $training)
                        <div class="border rounded-lg shadow-sm p-5 bg-gray-50 hover:shadow-md transition">
                            <h4 class="font-bold text-lg text-blue-600 mb-2">{{ $training->nama_pelatihan }}</h4>
                            <p class="text-sm text-gray-600 mb-1"><strong>Instruktur:</strong>
                                {{ $training->instruktur ?? '-' }}</p>
                            <p class="text-sm text-gray-600 mb-1"><strong>Metode:</strong>
                                {{ $training->metode_pelaksanaan }}</p>
                            <p class="text-sm text-gray-600 mb-1"><strong>Jadwal:</strong>
                                {{ \Carbon\Carbon::parse($training->tanggal_mulai)->format('d M Y') }} s/d
                                {{ \Carbon\Carbon::parse($training->tanggal_selesai)->format('d M Y') }}</p>
                            <p class="text-sm text-gray-600 mb-4"><strong>Sisa Kuota:</strong> {{ $training->kuota }}
                                peserta</p>

                            <a href="{{ route('department.trainings.request', $training->id) }}"
                                class="block text-center bg-blue-500 text-black px-4 py-2 rounded shadow hover:bg-blue-600 transition">
                                Ajukan Karyawan
                            </a>
                        </div>
                    @empty
                        <div
                            class="col-span-full p-4 bg-yellow-100 text-yellow-700 border border-yellow-400 rounded-md text-center">
                            Saat ini belum ada pelatihan yang pendaftarannya dibuka.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
