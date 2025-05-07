<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class CandidatesController extends Controller
{
    public function index()
    {
        // Logic to fetch and display candidates
        $canditates = Candidate::all();
        return view('apps.candidate', compact('canditates'));
    }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ketua_name'    => 'required|string|max:255',
            'wakil_name'    => 'required|string|max:255',
            'description'   => 'nullable|string|max:500',
            'ketua_avatar'  => 'required|image|mimes:jpeg,png,jpg',
            'wakil_avatar'  => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Cek duplikat paslon
        $exists = Candidate::where('ketua_name', $request->ketua_name)
                    ->where('wakil_name', $request->wakil_name)
                    ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                'ketua_name' => 'Paslon dengan nama ketua & wakil ini sudah ada.',
            ])->withInput();
        }

        // Dapatkan nomor urut berikutnya
        $nextNumber = (Candidate::max('candidate_number') ?? 0) + 1;

        // Pastikan direktori ada
        $ketuaDir = 'candidates/ketua';
        $wakilDir = 'candidates/wakil';

        if (!Storage::disk('public')->exists($ketuaDir)) {
            Storage::disk('public')->makeDirectory($ketuaDir);
        }

        if (!Storage::disk('public')->exists($wakilDir)) {
            Storage::disk('public')->makeDirectory($wakilDir);
        }

        // Upload gambar ketua
        $ketuaFile = $request->file('ketua_avatar');
        $ketuaFileName = Str::slug($request->ketua_name) . '_candidates-' . $nextNumber . '.' . $ketuaFile->getClientOriginalExtension();
        $ketuaPath = $ketuaFile->storeAs($ketuaDir, $ketuaFileName, 'public');

        if (!$ketuaPath || !Storage::disk('public')->exists($ketuaPath)) {
            return redirect()->back()->withErrors(['ketua_avatar' => 'Upload foto ketua gagal.'])->withInput();
        }

        // Upload gambar wakil
        $wakilFile = $request->file('wakil_avatar');
        $wakilFileName = Str::slug($request->wakil_name) . '_candidates-' . $nextNumber . '.' . $wakilFile->getClientOriginalExtension();
        $wakilPath = $wakilFile->storeAs($wakilDir, $wakilFileName, 'public');

        if (!$wakilPath || !Storage::disk('public')->exists($wakilPath)) {
            return redirect()->back()->withErrors(['wakil_avatar' => 'Upload foto wakil gagal.'])->withInput();
        }

        // Simpan ke database
        Candidate::create([
            'candidate_number'   => $nextNumber,
            'ketua_name'         => $request->ketua_name,
            'wakil_name'         => $request->wakil_name,
            'description'        => $request->description,
            'ketua_image_path'   => $ketuaPath,
            'wakil_image_path'   => $wakilPath,
        ]);

        return redirect()->back()->with('success', 'Paslon berhasil ditambahkan.');
    }

    public function deleteAll(Request $request)
    {
        try {
            Candidate::query()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Semua data votes dan candidates berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.'.$e->getMessage()
            ]);
        }
    }


}
