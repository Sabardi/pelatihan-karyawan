<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Karyawan: {{ $employee->nama }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('hrd.employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">NIK (Nomor Induk Karyawan)</label>
                            <input type="text" name="nik" value="{{ old('nik', $employee->nik) }}" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $employee->nama) }}" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Departemen</label>
                            <select name="department_id" class="w-full border-gray-300 rounded-md" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Jabatan</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan', $employee->jabatan) }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Status Karyawan</label>
                            <select name="status_karyawan" class="w-full border-gray-300 rounded-md" required>
                                <option value="tetap" {{ old('status_karyawan', $employee->status_karyawan) == 'tetap' ? 'selected' : '' }}>Tetap</option>
                                <option value="kontrak" {{ old('status_karyawan', $employee->status_karyawan) == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Nomor HP</label>
                            <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $employee->nomor_hp) }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Tanggal Join</label>
                            <input type="date" name="tanggal_join" value="{{ old('tanggal_join', $employee->tanggal_join) }}" class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update Data</button>
                        <a href="{{ route('hrd.employees.index') }}" class="ml-2 text-gray-600">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
