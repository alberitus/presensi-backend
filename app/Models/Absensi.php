<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'lokasi_masuk',
        'lokasi_keluar',
        'status',
        'is_fake_gps',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeToday($query)
    {
        $today = Carbon::now()->format('Y-m-d');
        return $query->whereDate('tanggal', $today);
    }

    public function getLokasiMasukMapUrlAttribute()
    {
        return "https://www.google.com/maps/search/?api=1&query=" . urlencode($this->lokasi_masuk);
    }

    public function getLokasiKeluarMapUrlAttribute()
    {
        return "https://www.google.com/maps/search/?api=1&query=" . urlencode($this->lokasi_keluar);
    }
}
