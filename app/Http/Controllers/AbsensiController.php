<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $attendance = Absensi::whereDate('tanggal', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('attendance.index', compact('attendance'));
    }

    public function filter(Request $request)
    {
        $start = $request->start_date ?? now()->toDateString();
        $end = $request->end_date ?? now()->toDateString();

        $attendance = Absensi::whereBetween('tanggal', [$start, $end])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('attendance.index', compact('attendance'))
            ->with([
                'start_date' => $start,
                'end_date' => $end,
            ]);
    }
}
