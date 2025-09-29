<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users',
            'nama_lengkap' => 'required',
            'division' => 'required',
            'tanggal_masuk' => 'required|date',
            'status_karyawan' => 'required',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'division' => $request->division,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status_karyawan' => $request->status_karyawan,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $request->validate([
            'nik' => 'unique:users,nik,' . $id,
            'tanggal_masuk' => 'date',
            'password' => 'nullable|min:6',
        ]);

        $user->update(array_filter([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'division' => $request->division,
            'tanggal_masuk' => $request->tanggal_masuk,
            'status_karyawan' => $request->status_karyawan,
            'role' => $request->role,
            'password' => $request->password ? bcrypt($request->password) : null,
        ]));

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
