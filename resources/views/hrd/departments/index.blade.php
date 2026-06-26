<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Data Departemen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 h-fit">
                <h3 class="font-bold text-gray-700 mb-4">Tambah Departemen Baru</h3>

                <form action="{{ route('hrd.departments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm text-gray-700 mb-1">Nama Departemen</label>
                        <input type="text" name="nama_departemen" class="w-full border-gray-300 rounded-md shadow-sm" required placeholder="Misal: Marketing">
                        @error('nama_departemen')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Simpan</button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:col-span-2">
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
                @endif

                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Nama Departemen</th>
                            <th class="border border-gray-300 px-4 py-2 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $dept)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-medium">{{ $dept->nama_departemen }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <form action="{{ route('hrd.departments.destroy', $dept->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus departemen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Belum ada data departemen.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
