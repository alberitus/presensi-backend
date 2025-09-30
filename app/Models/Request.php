<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'keterangan',
        'tanggal_mulai',
        'tanggal_selesai',
        'bukti_dokumen',
        'is_approved'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    public function getIsApprovedBadgeAttribute(): string
    {
        return match ($this->is_approved) {
            'disetujui' => '<span class="badge bg-success text-white">Disetujui</span>',
            'ditolak'   => '<span class="badge bg-danger text-white">Ditolak</span>',
            default     => '<span class="badge bg-warning text-white">Menunggu</span>',
        };
    }
}
