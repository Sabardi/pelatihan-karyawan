<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pelatihan: {{ $training->nama_pelatihan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('hrd.trainings.update', $training->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 mb-4">
                            <label class="block text-gray-700">Nama Pelatihan</label>
                            <input type="text" name="nama_pelatihan"
                                value="{{ old('nama_pelatihan', $training->nama_pelatihan) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="col-span-2 mb-4">
                            <label class="block text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('deskripsi', $training->deskripsi) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Instruktur</label>
                            <input type="text" name="instruktur"
                                value="{{ old('instruktur', $training->instruktur) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Metode Pelaksanaan</label>
                            <select name="metode_pelaksanaan" class="w-full border-gray-300 rounded-md shadow-sm"
                                required>
                                <option value="OFFLINE"
                                    {{ old('metode_pelaksanaan', $training->metode_pelaksanaan) == 'OFFLINE' ? 'selected' : '' }}>
                                    Offline</option>
                                <option value="ONLINE"
                                    {{ old('metode_pelaksanaan', $training->metode_pelaksanaan) == 'ONLINE' ? 'selected' : '' }}>
                                    Online</option>
                                <option value="HYBRID"
                                    {{ old('metode_pelaksanaan', $training->metode_pelaksanaan) == 'HYBRID' ? 'selected' : '' }}>
                                    Hybrid</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai', $training->tanggal_mulai) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai', $training->tanggal_selesai) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Kuota Peserta</label>
                            <input type="number" name="kuota" value="{{ old('kuota', $training->kuota) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm" required min="1">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Status Pendaftaran</label>
                            <select name="status_pendaftaran" class="w-full border-gray-300 rounded-md shadow-sm"
                                required>
                                <option value="dibuka"
                                    {{ old('status_pendaftaran', $training->status_pendaftaran) == 'dibuka' ? 'selected' : '' }}>
                                    Dibuka</option>
                                <option value="ditutup"
                                    {{ old('status_pendaftaran', $training->status_pendaftaran) == 'ditutup' ? 'selected' : '' }}>
                                    Ditutup</option>
                            </select>
                        </div>
                        <div class="col-span-2 mb-4">
                            <label class="block text-gray-700">Lokasi / Link Meeting</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $training->lokasi) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded">Update Data</button>
                        <a href="{{ route('hrd.trainings.index') }}" class="ml-2 text-gray-600">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
