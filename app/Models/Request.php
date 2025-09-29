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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
