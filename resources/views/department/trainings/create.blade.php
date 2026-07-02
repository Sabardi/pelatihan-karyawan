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

        <!-- Header Page -->
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Form Pengajuan</h2>
            <p class="text-sm text-slate-500 mt-2 font-medium">Ajukan karyawan Anda untuk mengikuti program pelatihan terpilih.</p>
        </div>

        <!-- Training Info Card -->
        <div class="bg-blue-50 rounded-[24px] p-6 border border-blue-100">
            <h3 class="font-extrabold text-blue-900 text-lg mb-4 flex items-center gap-2">
                <i class="ph-fill ph-graduation-cap"></i> {{ $training->nama_pelatihan }}
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-[11px] font-bold text-blue-800/60 uppercase tracking-wider">Metode: <span class="text-blue-900">{{ $training->metode_pelaksanaan }}</span></div>
                <div class="text-[11px] font-bold text-blue-800/60 uppercase tracking-wider">Sisa Kuota: <span class="text-blue-900">{{ $training->kuota }}</span></div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[32px] p-8 shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-slate-100">
            @if(session('error'))
                <div class="mb-6 p-4 bg-rose-50 text-rose-700 rounded-2xl text-sm font-bold border border-rose-100">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('department.trainings.store', $training->id) }}" method="POST" class="space-y-8">
                @csrf

                <div>
                    <label class="form-label">Pilih Karyawan</label>
                    <div class="relative group">
                        <select name="employee_id" class="form-input appearance-none cursor-pointer" required>
                            <option value="" disabled selected>-- Pilih Karyawan --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->nama }} — {{ $employee->jabatan }} ({{ $employee->nik }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center px-2 text-slate-400 group-hover:text-slate-600 transition duration-200">
                            <i class="ph-bold ph-caret-down"></i>
                        </div>
                    </div>
                    @error('employee_id')
                        <p class="text-rose-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Action -->
                <div class="flex items-center gap-4 pt-4">
                    <a href="{{ route('department.trainings.index') }}" class="flex-1 text-center py-3.5 rounded-2xl font-bold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="flex-[2] py-3.5 rounded-2xl font-bold text-white bg-slate-800 hover:bg-slate-900 transition shadow-lg hover:shadow-xl">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
