<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Departemen: {{ $department->nama_departemen }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('superadmin.departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Departemen</label>
                        <input type="text" name="nama_departemen" value="{{ $department->nama_departemen }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" class="w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ $department->deskripsi }}</textarea>
                    </div>

                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update Data</button>
                    <a href="{{ route('superadmin.departments.index') }}" class="ml-2 text-gray-600">Batal</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
