<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Mengambil semua data karyawan beserta nama departemennya
        $employees = Employee::with('department')->get();
        return view('hrd.employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('hrd.employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:employees,nik',
            'department_id' => 'required|exists:departments,id',
            'jabatan' => 'nullable|string|max:255',
            'status_karyawan' => 'required|in:tetap,kontrak',
            'email' => 'nullable|email',
            'nomor_hp' => 'nullable|string',
            'tanggal_join' => 'nullable|date',
        ]);

        Employee::create($request->all());

        return redirect()->route('hrd.employees.index')->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('hrd.employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|unique:employees,nik,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'jabatan' => 'nullable|string|max:255',
            'status_karyawan' => 'required|in:tetap,kontrak',
            'email' => 'nullable|email',
            'nomor_hp' => 'nullable|string',
            'tanggal_join' => 'nullable|date',
        ]);

        $employee->update($request->all());

        return redirect()->route('hrd.employees.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('hrd.employees.index')->with('success', 'Data karyawan berhasil dihapus!');
    }
}
