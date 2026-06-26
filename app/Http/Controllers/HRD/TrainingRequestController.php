<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\TrainingRequest;
use App\Models\TrainingParticipant;
use Illuminate\Http\Request;

class TrainingRequestController extends Controller
{
    public function index()
    {
        $requests = TrainingRequest::with(['training', 'employee', 'diajukanOleh'])
            ->latest()
            ->get();

        return view('hrd.requests.index', compact('requests'));
    }

    public function process(Request $request, TrainingRequest $trainingRequest)
    {
        // Sesuaikan validasi dengan ENUM database
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'catatan_admin' => 'nullable|string|max:255',
        ]);

        $trainingRequest->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Jika disetujui (approved), masukkan ke tabel peserta
        if ($request->status == 'approved') {
            $isParticipant = TrainingParticipant::where('employee_id', $trainingRequest->employee_id)
                ->where('training_id', $trainingRequest->training_id)
                ->exists();

         if (!$isParticipant) {
                TrainingParticipant::create([
                    'employee_id' => $trainingRequest->employee_id,
                    'training_id' => $trainingRequest->training_id,

                    // Akhirnya pakai nilai yang benar-benar ada di database! 🎉
                    'status_peserta' => 'disetujui',
                ]);
            }
        }

        return redirect()->route('hrd.requests.index')
            ->with('success', 'Status pengajuan karyawan berhasil diperbarui!');
    }
}
