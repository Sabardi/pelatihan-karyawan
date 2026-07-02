{{-- <x-app-layout>
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
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        Tambah Pelatihan Baru
    </x-slot>

    <style>
        .form-input {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border-radius: 1rem;
            border: 2px solid #eef2f7;
            background-color: rgba(241, 245, 249, 0.6);
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            outline: none;
            transition: all .15s ease-in-out;
        }

        .form-input.pl-11 {
            padding-left: 2.75rem;
        }

        .form-input:focus {
            background-color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 8px 28px rgba(37, 99, 235, 0.08);
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-bottom: 0.625rem;
            margin-left: 0.25rem;
        }

        textarea.form-input {
            min-height: 120px;
            resize: vertical;
        }
    </style>

    <div class="w-full space-y-6">

        <div class="mb-10">
            <nav class="flex items-center text-sm text-slate-500 mb-3 font-semibold">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-blue-600 transition duration-200">
                    <i class="ph-fill ph-squares-four text-lg"></i> Dashboard
                </a>
                <i class="ph-bold ph-caret-right text-slate-300 mx-2 text-xs"></i>
                <a href="{{ route('hrd.trainings.index') }}" class="flex items-center gap-2 hover:text-blue-600 transition duration-200">
                    <i class="ph-fill ph-graduation-cap text-lg"></i> Katalog Pelatihan
                </a>
                <i class="ph-bold ph-caret-right text-slate-300 mx-2 text-xs"></i>
                <span class="text-slate-800">Tambah Pelatihan</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-2">
                        Tambah Pelatihan Baru
                    </h2>
                    <p class="text-sm text-slate-500 font-medium">Lengkapi formulir di bawah ini untuk menambahkan program pelatihan ke dalam katalog.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[32px] p-8 md:p-12 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100">

            <form action="{{ route('hrd.trainings.store') }}" method="POST" class="space-y-10">
                @csrf

                <div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner">
                            <i class="ph-fill ph-info text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-800">Informasi Dasar</h3>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Detail Program Pelatihan</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="md:col-span-2">
                            <label class="form-label">Nama Pelatihan</label>
                            <input type="text" name="nama_pelatihan" value="{{ old('nama_pelatihan') }}" placeholder="Contoh: Ahli K3 Kimia Umum" class="form-input" required />
                            @error('nama_pelatihan')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label">Deskripsi Program</label>
                            <textarea name="deskripsi" placeholder="Tuliskan tujuan dan cakupan materi pelatihan ini..." class="form-input" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Metode Pelaksanaan</label>
                            <div class="relative group">
                                <select name="metode_pelaksanaan" class="form-input appearance-none cursor-pointer" required>
                                    <option value="" disabled {{ old('metode_pelaksanaan') == '' ? 'selected' : '' }}>Pilih metode</option>
                                    <option value="OFFLINE" {{ old('metode_pelaksanaan') == 'OFFLINE' ? 'selected' : '' }}>OFFLINE (Tatap Muka)</option>
                                    <option value="ONLINE" {{ old('metode_pelaksanaan') == 'ONLINE' ? 'selected' : '' }}>ONLINE (Daring)</option>
                                    <option value="HYBRID" {{ old('metode_pelaksanaan') == 'HYBRID' ? 'selected' : '' }}>HYBRID (Campuran)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center px-2 text-slate-400 group-hover:text-slate-600 transition duration-200">
                                    <i class="ph-bold ph-caret-down"></i>
                                </div>
                            </div>
                            @error('metode_pelaksanaan')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Kuota Peserta</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                                    <i class="ph-fill ph-users text-lg"></i>
                                </div>
                                <input type="number" name="kuota" value="{{ old('kuota') }}" placeholder="Contoh: 30" min="1" class="form-input pl-11" required />
                            </div>
                            @error('kuota')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-200 to-transparent my-10"></div>

                <div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shadow-inner">
                            <i class="ph-fill ph-chalkboard-teacher text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-800">Pelaksanaan</h3>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Jadwal & Penyelenggara</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-8">
                        <div>
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="form-input text-slate-600 uppercase text-xs tracking-wide" required />
                            @error('tanggal_mulai')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="form-input text-slate-600 uppercase text-xs tracking-wide" required />
                            @error('tanggal_selesai')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Nama Instruktur / Vendor</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                                    <i class="ph-fill ph-user-circle text-lg"></i>
                                </div>
                                <input type="text" name="instruktur" value="{{ old('instruktur') }}" placeholder="Nama instruktur..." class="form-input pl-11" required />
                            </div>
                            @error('instruktur')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- TAMBAHAN: Input Lokasi / Link Meeting -->
                        <div class="md:col-span-2">
                            <label class="form-label">Lokasi / Link Meeting</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                                    <i class="ph-fill ph-map-pin text-lg"></i>
                                </div>
                                <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Ruang Meeting A atau Link Zoom/Google Meet" class="form-input pl-11" required />
                            </div>
                            @error('lokasi')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="lg:col-span-3">
                            <label class="form-label">Status Pendaftaran Awal</label>
                            <div class="relative group md:w-1/3">
                                <select name="status_pendaftaran" class="form-input appearance-none cursor-pointer" required>
                                    <option value="dibuka" {{ old('status_pendaftaran') == 'dibuka' ? 'selected' : '' }}>DIBUKA</option>
                                    <option value="ditutup" {{ old('status_pendaftaran') == 'ditutup' ? 'selected' : '' }}>DITUTUP</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center px-2 text-slate-400 group-hover:text-slate-600 transition duration-200">
                                    <i class="ph-bold ph-caret-down"></i>
                                </div>
                            </div>
                            <p class="text-xs text-slate-400 mt-2 ml-1 font-medium">*Jika diset DITUTUP, karyawan tidak akan bisa mendaftar pelatihan ini.</p>
                            @error('status_pendaftaran')
                                <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-4 mt-12 pt-8 border-t border-slate-100">
                    <a href="{{ route('hrd.trainings.index') }}" class="w-full sm:w-auto">
                        <button type="button" class="w-full px-8 py-3.5 rounded-2xl font-semibold text-slate-600 bg-white border-2 border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition duration-200 hover:shadow-sm">
                            Batal
                        </button>
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-2xl font-semibold text-white bg-blue-600 hover:bg-blue-700 transition duration-200 shadow-[0_8px_24px_rgba(37,99,235,0.25)] hover:shadow-[0_12px_32px_rgba(37,99,235,0.35)] flex items-center justify-center gap-2">
                        <i class="ph-bold ph-check"></i>
                        <span>Simpan Pelatihan</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
