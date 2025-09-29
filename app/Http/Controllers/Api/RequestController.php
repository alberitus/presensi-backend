<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    /**
     * Menampilkan semua request
     */
    public function index()
    {
        $requests = RequestModel::with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua request',
            'data'    => $requests
        ], 200);
    }

    /**
     * Menyimpan request baru
     */
    public function store(HttpRequest $request)
{
    $validator = Validator::make($request->all(), [
        'user_id'        => 'required|exists:users,id',
        'status'         => 'required|string|max:50',
        'keterangan'     => 'nullable|string',
        'tanggal_mulai'  => 'required|date',
        'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
        'bukti_dokumen'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'is_approved'    => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors'  => $validator->errors()
        ], 422);
    }

    try {
        $data = [
            'user_id'        => $request->user_id,
            'status'         => $request->status,
            'keterangan'     => $request->keterangan,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'tanggal_selesai'=> $request->tanggal_selesai,
            'is_approved'    => $request->input('is_approved', false),
        ];

        // Upload bukti dokumen jika ada
        if ($request->hasFile('bukti_dokumen')) {
            $data['bukti_dokumen'] = $request->file('bukti_dokumen')
                                            ->store('bukti_dokumen', 'public');
        }

        $newRequest = RequestModel::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Request berhasil dibuat',
            'data'    => $newRequest
        ], 201);
        
    } catch (\Exception $e) {
        Log::error('Error creating request: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Menampilkan detail request
     */
    public function show($id)
    {
        $req = RequestModel::with('user')->find($id);

        if (!$req) {
            return response()->json([
                'success' => false,
                'message' => 'Request tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail request',
            'data'    => $req
        ], 200);
    }

    /**
     * Update request
     */
    public function update(HttpRequest $request, $id)
    {
        $req = RequestModel::find($id);

        if (!$req) {
            return response()->json([
                'success' => false,
                'message' => 'Request tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status'          => 'sometimes|required|string|max:50',
            'keterangan'      => 'nullable|string',
            'tanggal_mulai'   => 'sometimes|required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'bukti_dokumen'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'is_approved'     => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'status',
            'keterangan',
            'tanggal_mulai',
            'tanggal_selesai',
            'is_approved'
        ]);

        // Ganti file jika ada upload baru
        if ($request->hasFile('bukti_dokumen')) {
            if ($req->bukti_dokumen && Storage::disk('public')->exists($req->bukti_dokumen)) {
                Storage::disk('public')->delete($req->bukti_dokumen);
            }
            $data['bukti_dokumen'] = $request->file('bukti_dokumen')
                                            ->store('bukti_dokumen', 'public');
        }

        $req->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Request berhasil diupdate',
            'data'    => $req
        ], 200);
    }

    /**
     * Hapus request
     */
    public function destroy($id)
    {
        $req = RequestModel::find($id);

        if (!$req) {
            return response()->json([
                'success' => false,
                'message' => 'Request tidak ditemukan'
            ], 404);
        }

        if ($req->bukti_dokumen && Storage::disk('public')->exists($req->bukti_dokumen)) {
            Storage::disk('public')->delete($req->bukti_dokumen);
        }

        $req->delete();

        return response()->json([
            'success' => true,
            'message' => 'Request berhasil dihapus'
        ], 200);
    }
}