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
        // Cek jika ada pasangan dengan nama sama (kombinasi)
        $exists = Candidate::where('ketua_name', $request->ketua_name)
                    ->where('wakil_name', $request->wakil_name)
                    ->exists();

        if ($exists) {
            return redirect()->back()->withErrors([
                'ketua_name' => 'Paslon dengan nama ketua & wakil ini sudah ada.',
            ])->withInput();
        }

        // Upload gambar dengan nama sesuai ketua_name atau wakil_name dan candidate_number
        $nextNumber = (Candidate::max('candidate_number') ?? 0) + 1;

        $ketuaPath = $request->hasFile('ketua_avatar')
            ? $request->file('ketua_avatar')->storeAs(
            'candidates/ketua',
            strtolower(str_replace(' ', '-', $request->ketua_name)) . '_candidates-' . $nextNumber . '.' . $request->file('ketua_avatar')->getClientOriginalExtension(),
            'public'
            )
            : null;

        $wakilPath = $request->hasFile('wakil_avatar')
            ? $request->file('wakil_avatar')->storeAs(
            'candidates/wakil',
            strtolower(str_replace(' ', '-', $request->wakil_name)) . '_candidates-' . $nextNumber . '.' . $request->file('wakil_avatar')->getClientOriginalExtension(),
            'public'
            )
            : null;

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
