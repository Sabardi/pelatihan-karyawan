<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Pengajuan Pelatihan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-md">
                    <h3 class="font-bold text-lg text-blue-800 mb-1">Detail Pelatihan yang Dipilih:</h3>
                    <p class="text-gray-700"><strong>Nama Pelatihan:</strong> {{ $training->nama_pelatihan }}</p>
                    <p class="text-gray-700"><strong>Metode:</strong> {{ $training->metode_pelaksanaan }}</p>
                    <p class="text-gray-700"><strong>Kuota Tersisa:</strong> {{ $training->kuota }} peserta</p>
                </div>

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('department.trainings.store', $training->id) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Pilih Karyawan dari Departemen Anda</label>
                        <select name="employee_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    [{{ $employee->nik }}] - {{ $employee->nama }} ({{ $employee->jabatan }})
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 border-t pt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Kirim Pengajuan</button>
                        <a href="{{ route('department.trainings.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
