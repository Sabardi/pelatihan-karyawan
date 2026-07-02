<x-app-layout>
    {{-- <x-slot name="header">Edit Departemen</x-slot> --}}

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

    <div class="w-full max-w-2xl mx-auto space-y-6">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Edit Departemen</h2>
            <p class="text-sm text-slate-500 mt-2 font-medium">Perbarui informasi departemen: {{ $department->nama_departemen }}</p>
        </div>

        <div class="bg-white rounded-[32px] p-8 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100">
            <form action="{{ route('superadmin.departments.update', $department->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <label class="form-label">Nama Departemen</label>
                    <input type="text" name="nama_departemen" value="{{ old('nama_departemen', $department->nama_departemen) }}" class="form-input" required />
                    @error('nama_departemen')
                        <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" class="form-input">{{ old('deskripsi', $department->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('superadmin.departments.index') }}" class="flex-1 text-center py-3.5 rounded-2xl font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="flex-[2] py-3.5 rounded-2xl font-bold text-white bg-amber-600 hover:bg-amber-700 transition shadow-lg hover:shadow-xl">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
