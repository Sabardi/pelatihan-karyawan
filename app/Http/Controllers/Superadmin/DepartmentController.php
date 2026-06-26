<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('superadmin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('superadmin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Department::create([
            'nama_departemen' => $request->nama_departemen,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('superadmin.departments.index')->with('success', 'Departemen baru berhasil ditambahkan!');
    }

    public function edit(Department $department)
    {
        return view('superadmin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $department->update([
            'nama_departemen' => $request->nama_departemen,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('superadmin.departments.index')->with('success', 'Data departemen berhasil diperbarui!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('superadmin.departments.index')->with('success', 'Departemen berhasil dihapus!');
    }
}
