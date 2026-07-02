<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_pelatihan', 'deskripsi', 'instruktur', 'tanggal_mulai', 'tanggal_selesai', 'kuota', 'lokasi', 'metode_pelaksanaan', 'status_pendaftaran'])]
class Training extends Model
{
    use HasFactory;

    public function requests()
    {
        return $this->hasMany(TrainingRequest::class);
    }

    public function participants()
    {
        return $this->hasMany(TrainingParticipant::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'training_participants', 'training_id', 'employee_id')
            ->withPivot('status_peserta', 'created_at');
    }
}
