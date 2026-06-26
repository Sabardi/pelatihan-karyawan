<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('superadmin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                            class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Password (Kosongkan jika tidak ingin diubah)</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Role</label>
                        <select name="role" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="departemen" {{ $user->role == 'departemen' ? 'selected' : '' }}>Admin
                                Departemen</option>
                            <option value="hrd" {{ $user->role == 'hrd' ? 'selected' : '' }}>HRD</option>
                            <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>Superadmin
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Role</label>
                        <select name="role" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="departemen" {{ old('role', $user->role) == 'departemen' ? 'selected' : '' }}>
                                Admin Departemen</option>
                            <option value="hrd" {{ old('role', $user->role) == 'hrd' ? 'selected' : '' }}>HRD
                            </option>
                            <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>
                                Superadmin</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Departemen</label>
                        <select name="department_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            {{-- <option value="">-- Pilih Departemen --</option> --}}
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ old('department_id', $user->department_id) == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded">Update Data</button>
                    <a href="{{ route('superadmin.users.index') }}" class="ml-2 text-gray-600">Batal</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
