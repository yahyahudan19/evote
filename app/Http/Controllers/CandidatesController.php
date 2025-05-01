<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

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
        dd($request->all());
        // Validasi input
        $request->validate([
            'ketua_name'    => 'required|string|max:255',
            'wakil_name'    => 'required|string|max:255',
            'description'   => 'nullable|string|max:500',
            'ketua_avatar'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'wakil_avatar'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cek duplikasi kombinasi paslon
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

        // Upload gambar ketua
        $ketuaPath = $request->file('ketua_avatar')->storeAs(
            'candidates/ketua',
            strtolower(str_replace(' ', '-', $request->ketua_name)) . '_candidates-' . $nextNumber . '.' . $request->file('ketua_avatar')->getClientOriginalExtension(),
            'public'
        );

        // Upload gambar wakil
        $wakilPath = $request->file('wakil_avatar')->storeAs(
            'candidates/wakil',
            strtolower(str_replace(' ', '-', $request->wakil_name)) . '_candidates-' . $nextNumber . '.' . $request->file('wakil_avatar')->getClientOriginalExtension(),
            'public'
        );

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

}
