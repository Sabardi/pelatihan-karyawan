<x-app-layout>

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
    </style>

    <div class="w-full max-w-2xl mx-auto space-y-6">
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Edit Pengguna</h2>
            <p class="text-sm text-slate-500 mt-2 font-medium">Perbarui informasi akun untuk pengguna: {{ $user->name }}</p>
        </div>

        <div class="bg-white rounded-[32px] p-8 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100">
            <form action="{{ route('superadmin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required />
                </div>

                <div>
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required />
                </div>

                <div>
                    <label class="form-label">Kata Sandi (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" placeholder="••••••••" class="form-input" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="form-label">Role Akses</label>
                        <select name="role" class="form-input appearance-none cursor-pointer" required>
                            <option value="departemen" {{ old('role', $user->role) == 'departemen' ? 'selected' : '' }}>Admin Departemen</option>
                            <option value="hrd" {{ old('role', $user->role) == 'hrd' ? 'selected' : '' }}>HRD</option>
                            <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label">Departemen</label>
                        <select name="department_id" class="form-input appearance-none cursor-pointer">
                            <option value="">-- Pilih Departemen --</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $user->department_id) == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-100 mt-8">
                    <a href="{{ route('superadmin.users.index') }}" class="flex-1 text-center py-3.5 rounded-2xl font-bold text-slate-600 hover:bg-slate-50 transition">
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
