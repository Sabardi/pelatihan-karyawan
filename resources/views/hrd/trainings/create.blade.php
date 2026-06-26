<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Pelatihan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                        <p class="font-bold mb-2">Gagal Menyimpan! Harap perbaiki kesalahan berikut:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('hrd.trainings.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Nama Pelatihan</label>
                            <input type="text" name="nama_pelatihan" value="{{ old('nama_pelatihan') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="col-span-2 mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Instruktur</label>
                            <input type="text" name="instruktur" value="{{ old('instruktur') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Metode Pelaksanaan</label>
                            <select name="metode_pelaksanaan" class="w-full border-gray-300 rounded-md shadow-sm"
                                required>
                                <option value="OFFLINE" {{ old('metode_pelaksanaan') == 'OFFLINE' ? 'selected' : '' }}>
                                    Offline</option>
                                <option value="ONLINE" {{ old('metode_pelaksanaan') == 'ONLINE' ? 'selected' : '' }}>
                                    Online</option>
                                <option value="HYBRID" {{ old('metode_pelaksanaan') == 'HYBRID' ? 'selected' : '' }}>
                                    Hybrid</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Kuota Peserta</label>
                            <input type="number" name="kuota" value="{{ old('kuota') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required min="1">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Status Pendaftaran</label>
                            <select name="status_pendaftaran" class="w-full border-gray-300 rounded-md shadow-sm"
                                required>
                                <option value="dibuka" {{ old('status_pendaftaran') == 'dibuka' ? 'selected' : '' }}>
                                    Dibuka</option>
                                <option value="ditutup" {{ old('status_pendaftaran') == 'ditutup' ? 'selected' : '' }}>
                                    Ditutup</option>
                            </select>
                        </div>

                        <div class="col-span-2 mb-4">
                            <label class="block text-gray-700 font-medium mb-1">Lokasi / Link Meeting</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="mt-4 border-t pt-4">
                        <button type="submit"
                            class="bg-blue-600 text-black px-4 py-2 rounded shadow hover:bg-blue-700 transition">Simpan
                            Data</button>
                        <a href="{{ route('hrd.trainings.index') }}"
                            class="ml-2 text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
