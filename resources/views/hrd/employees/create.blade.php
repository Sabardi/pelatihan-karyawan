<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Karyawan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('hrd.employees.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">NIK (Nomor Induk Karyawan)</label>
                            <input type="text" name="nik" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Departemen</label>
                            <select name="department_id" class="w-full border-gray-300 rounded-md" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Jabatan</label>
                            <input type="text" name="jabatan" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Status Karyawan</label>
                            <select name="status_karyawan" class="w-full border-gray-300 rounded-md" required>
                                <option value="tetap">Tetap</option>
                                <option value="kontrak">Kontrak</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input type="email" name="email" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Nomor HP</label>
                            <input type="text" name="nomor_hp" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Tanggal Join</label>
                            <input type="date" name="tanggal_join" class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Simpan Data</button>
                        <a href="{{ route('hrd.employees.index') }}" class="ml-2 text-gray-600">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
