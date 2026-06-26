<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Karyawan
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

                <a href="{{ route('hrd.employees.create') }}" class="mb-4 inline-block bg-blue-500 text-black px-4 py-2 rounded">Tambah Karyawan</a>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">NIK</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nama</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Departemen</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jabatan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $employee->nik }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $employee->nama }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $employee->department->nama_departemen ?? '-' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $employee->jabatan }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($employee->status_karyawan) }}</td>
                             <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ route('hrd.employees.edit', $employee->id) }}" class="text-yellow-500">Edit</a> |

                                    <form action="{{ route('hrd.employees.destroy', $employee->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data karyawan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Belum ada data karyawan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
