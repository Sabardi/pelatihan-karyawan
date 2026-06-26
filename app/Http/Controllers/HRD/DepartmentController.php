<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('hrd.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departments,nama_departemen',
        ]);

        Department::create($request->all());

        return redirect()->route('hrd.departments.index')->with('success', 'Departemen berhasil ditambahkan!');
    }

    public function destroy(Department $department)
    {
        // Cek dulu apakah ada karyawan di departemen ini, cegah hapus jika ada (opsional tapi disarankan)
        if ($department->employees()->count() > 0) {
            return redirect()->route('hrd.departments.index')->with('error', 'Gagal menghapus! Masih ada karyawan di departemen ini.');
        }

        $department->delete();
        return redirect()->route('hrd.departments.index')->with('success', 'Departemen berhasil dihapus!');
    }
}
