<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    /**
     * Menampilkan semua absensi user
     */
    public function index(Request $request)
    {
        $absensis = Absensi::where('user_id', $request->user_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $absensis
        ], 200);
    }

    /**
     * Simpan absensi masuk
     */
    public function absenMasuk(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lokasi_masuk' => 'required|string',
            'status' => 'required|in:hadir,terlambat,alpha,izin,sakit',
        ]);

        $tanggal = Carbon::today()->toDateString();

        // Cek jika sudah absen masuk
        $absensi = Absensi::firstOrNew([
            'user_id' => $request->user_id,
            'tanggal' => $tanggal,
        ]);

        $absensi->jam_masuk = now()->format('H:i:s');
        $absensi->lokasi_masuk = $request->lokasi_masuk;
        $absensi->status = $request->status;
        $absensi->is_fake_gps = $request->input('is_fake_gps', false);
        $absensi->save();

        return response()->json([
            'status' => true,
            'message' => 'Absensi masuk berhasil',
            'data' => $absensi
        ], 201);
    }

    /**
     * Simpan absensi keluar
     */
    public function absenKeluar(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lokasi_keluar' => 'required|string',
        ]);

        $tanggal = Carbon::today()->toDateString();

        $absensi = Absensi::where('user_id', $request->user_id)
            ->where('tanggal', $tanggal)
            ->first();

        if (!$absensi) {
            return response()->json([
                'status' => false,
                'message' => 'Absensi masuk belum dilakukan'
            ], 404);
        }

        $absensi->jam_keluar = now()->format('H:i:s');
        $absensi->lokasi_keluar = $request->lokasi_keluar;
        $absensi->save();

        return response()->json([
            'status' => true,
            'message' => 'Absensi keluar berhasil',
            'data' => $absensi
        ], 200);
    }

    /**
     * Detail absensi tertentu
     */
    public function show($id)
    {
        $absensi = Absensi::find($id);

        if (!$absensi) {
            return response()->json([
                'status' => false,
                'message' => 'Data absensi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $absensi
        ], 200);
    }
}
