<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil total jumlah karyawan
        $employees = Employee::count();

        // 2. Mengambil jumlah karyawan (unik) yang sudah menyelesaikan pelatihan
        $trainedEmployees = DB::table('training_participants')
            ->where('status_peserta', 'selesai')
            ->distinct('employee_id')
            ->count('employee_id');

        // 3. Kirim kedua variabel ke view dashboard
        return view('dashboard', compact('employees', 'trainedEmployees'));
    }
}
