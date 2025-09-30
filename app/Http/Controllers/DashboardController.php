<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $attendances = Absensi::today()->get();
        $data = [
            'user'       => User::count(),
            'attendanceToday' => $attendances->isEmpty() ? 0 : $attendances,
            'requestThisMonth' => ModelsRequest::thisMonth()->count(),
        ];

        return view('index', $data);
    }
}
