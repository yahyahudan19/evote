<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
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
        $election = Election::first(); // Ambil election pertama (jika ada)
        return view('apps.candidate', compact('canditates','election'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ketua_name'    => 'required|string|max:255',
            // 'wakil_name'    => 'required|string|max:255',
            'description'   => 'nullable|string|max:500',
            'ketua_avatar'  => 'required|image|mimes:jpeg,png,jpg',
            // 'wakil_avatar'  => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Cek duplikat paslon
        $exists = Candidate::where('ketua_name', $request->ketua_name)
                    // ->where('wakil_name', $request->wakil_name)
                    ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                // 'ketua_name' => 'Paslon dengan nama ketua & wakil ini sudah ada.',
                'ketua_name' => 'Calon ini sudah ada.',
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
            return response()->json([
                'status' => 'warning',
                'message' => 'Upload foto ketua gagal.'
            ]);
        }

        // Upload gambar wakil
        // $wakilFile = $request->file('wakil_avatar');
        // // $wakilFileName = Str::slug($request->wakil_name) . '_candidates-' . $nextNumber . '.' . $wakilFile->getClientOriginalExtension();
        // // $wakilPath = $wakilFile->storeAs($wakilDir, $wakilFileName, 'public');
        // $wakilPath = $wakilFile->storeAs($wakilDir,'public');

        // if (!$wakilPath || !Storage::disk('public')->exists($wakilPath)) {
        //     return redirect()->back()->withErrors(['wakil_avatar' => 'Upload foto wakil gagal.'])->withInput();
        // }

        // Simpan ke database
        Candidate::create([
            'candidate_number'   => $nextNumber,
            'ketua_name'         => $request->ketua_name,
            // 'wakil_name'         => $request->wakil_name,
            'description'        => $request->description,
            'ketua_image_path'   => $ketuaPath,
            // 'wakil_image_path'   => $wakilPath,
        ]);
        

        return redirect()->back()->with('success', 'Paslon berhasil ditambahkan.');
    }

    public function deleteAll(Request $request)
    {
        try {
            // Ambil semua data candidates
            $candidates = Candidate::all();

            // Hapus gambar ketua dan wakil dari storage
            foreach ($candidates as $candidate) {
                if ($candidate->ketua_image_path) {
                    Storage::disk('public')->delete($candidate->ketua_image_path);
                }
                if ($candidate->wakil_image_path) {
                    Storage::disk('public')->delete($candidate->wakil_image_path);
                }
            }

            // Hapus semua data di tabel candidates
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

    public function delete($id)
    {
        try {
            // Cari data candidate berdasarkan ID
            $candidate = Candidate::findOrFail($id);

            // Hapus gambar ketua dan wakil jika ada
            if ($candidate->ketua_image_path) {
                // Hapus file ketua
                Storage::disk('public')->delete($candidate->ketua_image_path);
            }

            if ($candidate->wakil_image_path) {
                // Hapus file wakil
                Storage::disk('public')->delete($candidate->wakil_image_path);
            }

            // Hapus data candidate
            $candidate->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Paslon berhasil dihapus beserta gambarnya.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data. Coba lagi nanti.'
            ]);
        }
    }

    public function showEditForm($id)
    {
        // Ambil data candidate berdasarkan ID
        $candidate = Candidate::findOrFail($id);

        return response()->json($candidate);  // Kirim data untuk mengisi form edit
    }

    public function update(Request $request)
    {
        $request->validate([
            'ketua_name' => 'required|string',
            'wakil_name' => 'required|string',
            'description' => 'required|string',
            'ketua_avatar' => 'nullable|image|mimes:jpeg,png,jpg',
            'wakil_avatar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $candidate = Candidate::findOrFail($request->candidate_id);

        // Handle image upload for ketua
        if ($request->hasFile('ketua_avatar')) {
            // Hapus file lama
            Storage::disk('public')->delete($candidate->ketua_image_path);

            // Simpan file baru
            $ketuaPath = $request->file('ketua_avatar')->storeAs(
                'candidates/ketua',
                strtolower(str_replace(' ', '-', $request->ketua_name)) . '_candidates-' . $candidate->candidate_number . '.' . $request->file('ketua_avatar')->getClientOriginalExtension(),
                'public'
            );

            $candidate->ketua_image_path = $ketuaPath;
        }

        // Handle image upload for wakil
        if ($request->hasFile('wakil_avatar')) {
            // Hapus file lama
            Storage::disk('public')->delete($candidate->wakil_image_path);

            // Simpan file baru
            $wakilPath = $request->file('wakil_avatar')->storeAs(
                'candidates/wakil',
                strtolower(str_replace(' ', '-', $request->wakil_name)) . '_candidates-' . $candidate->candidate_number . '.' . $request->file('wakil_avatar')->getClientOriginalExtension(),
                'public'
            );

            $candidate->wakil_image_path = $wakilPath;
        }

        // Update other fields
        $candidate->ketua_name = $request->ketua_name;
        $candidate->wakil_name = $request->wakil_name;
        $candidate->description = $request->description;

        // Save the candidate
        $candidate->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Paslon berhasil diperbarui.'
        ]);
    }


}
