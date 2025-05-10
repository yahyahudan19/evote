<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ElectionsController extends Controller
{
    public function showElectionStatus()
    {
        // Ambil data waktu pemilihan dari database
        $election = Election::first(); // Ambil election pertama (jika ada)

        // Pastikan ada data pemilihan
        if (!$election) {
            return view('dashboard', ['error' => 'Waktu pemilihan tidak tersedia']);
        }

        // Kirimkan waktu pemilihan ke view
        return view('dashboard', [
            'end_time' => $election->end_time,
        ]);
    }

    public function updateElection(Request $request)
    {
        // dd($request->all()); // Uncomment to debug if necessary
        
        // Update data election
        $election = Election::first(); // Mengambil data election pertama (kalau lebih dari satu bisa diubah)
        $election->status = $request->status;

        // Pecah rentang waktu yang diterima menjadi dua waktu
        $timeRange = explode(' - ', $request->time);

        // Pastikan waktu yang diterima sesuai dengan format yang diinginkan
        try {
            // Mengonversi waktu yang diterima menjadi timestamp (format M/d/Y h:i A)
            $election->start_time = Carbon::createFromFormat('m/d/Y h:i A', $timeRange[0]);
            $election->end_time = Carbon::createFromFormat('m/d/Y h:i A', $timeRange[1]);

            // Periksa jika start_time melebihi waktu sekarang lebih dari 1 hari
            if ($election->start_time->diffInDays(Carbon::now(), false) < -1) {
            $election->status = 'N';
            }
        } catch (\Exception $e) {
            // Jika ada error format, tangani dengan error handling
            return redirect()->back()->with('error', 'Format tanggal/waktu tidak valid. Pastikan format yang dimasukkan sesuai.');
        }

        // Simpan data election yang sudah diupdate
        $election->save();

        return redirect()->back()->with('success', 'Election data updated successfully.');
    }



}
