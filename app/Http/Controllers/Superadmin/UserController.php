<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil semua data user beserta data departemennya
        $users = User::with('department')->get();

        return view('superadmin.users.index', compact('users'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('superadmin.users.create', compact('departments'));
    }

    // Fungsi baru untuk menyimpan data
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:superadmin,hrd,departemen',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        // 2. Logika keamanan ekstra: Jika role bukan departemen, kosongkan department_id
        $department_id = $request->role === 'departemen' ? $request->department_id : null;

        // 3. Simpan ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => $request->role,
            'department_id' => $department_id,
        ]);

        // 4. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('superadmin.users.index')->with('success', 'User baru berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $departments = Department::all();

        return view('superadmin.users.edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi input (perhatikan pengecualian email untuk user ini sendiri)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:superadmin,hrd,departemen',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $department_id = $request->role === 'departemen' ? $request->department_id : null;

        // Siapkan data yang akan diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'department_id' => $department_id,
        ];

        // Jika form password diisi, maka update passwordnya juga
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('superadmin.users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Keamanan: Cegah superadmin menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return redirect()->route('superadmin.users.index')->with('error', 'Gagal! Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('superadmin.users.index')->with('success', 'Data user berhasil dihapus!');
    }
}
