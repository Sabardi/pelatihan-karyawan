<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Departemen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="font-bold text-gray-700 mb-4">Ubah Nama Departemen</h3>

                <form action="{{ route('hrd.departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 mb-1">Nama Departemen</label>
                        <input type="text" name="nama_departemen" value="{{ old('nama_departemen', $department->nama_departemen) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('nama_departemen')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600">Update Data</button>
                        <a href="{{ route('hrd.departments.index') }}" class="text-gray-600 hover:underline text-sm">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
