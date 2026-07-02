<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\TrainingRequest;

class TrainingRequestController extends Controller
{
    // Menampilkan daftar pelatihan yang tersedia (status: dibuka)
    public function index()
    {
        $trainings = Training::where('status_pendaftaran', 'dibuka')->get();
        return view('department.trainings.index', compact('trainings'));
    }

    // Menampilkan form pengajuan untuk pelatihan tertentu
    public function create(Training $training)
    {
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Ambil hanya karyawan yang satu departemen dengan Admin ini
        $employees = Employee::where('department_id', $user->department_id)->get();

        return view('department.trainings.create', compact('training', 'employees'));
    }

    // Menyimpan data pengajuan ke database
    public function store(Request $request, Training $training)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Cek apakah karyawan ini sudah pernah diajukan untuk pelatihan yang sama
        $exists = TrainingRequest::where('employee_id', $request->employee_id)
                                 ->where('training_id', $training->id)
                                 ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Karyawan tersebut sudah terdaftar atau sedang diajukan dalam pelatihan ini.');
        }

        // Simpan pengajuan baru dengan status 'pending' (menunggu persetujuan HRD)
        TrainingRequest::create([
            'employee_id' => $request->employee_id,
            'training_id' => $training->id,
            'diajukan_oleh' => auth()->id(),
            'status' => 'pending', // default menunggu approval hrd
        ]);

        return redirect()->route('department.trainings.index')
            ->with('success', 'Pengajuan pelatihan karyawan berhasil dikirim ke HRD!');
    }

    // Menampilkan riwayat pengajuan yang pernah dibuat oleh Admin Departemen ini
    public function history()
    {
        $requests = TrainingRequest::with(['training', 'employee'])
            ->where('diajukan_oleh', auth()->id())
            ->latest()
            ->paginate(10);

        return view('department.trainings.history', compact('requests'));
    }
}
