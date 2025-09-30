<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $data = [
            'request' => ModelsRequest::orderBy('created_at', 'desc')->get(),
        ];
        return view('request.index', $data);
    }

    public function approve(Request $request, $id)
    {
        $req = ModelsRequest::findOrFail(decrypt($id));
        $req->is_approved = $request->is_approved;
        $req->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

}
