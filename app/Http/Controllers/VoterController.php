<?php

namespace App\Http\Controllers;

use App\Exports\VotersExport;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Http\Request;
use App\Imports\VotersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class VoterController extends Controller
{
    public function index()
    {
        // Logic to display a list of voters
        $candidates = Candidate::orderBy('candidate_number', 'asc')->get();
        return view('apps.voters', compact('candidates'));
    }

    public function admin()
    {
        // Logic to display a list of voters
        $voters = Voter::orderBy('created_at', 'desc')->get();
        return view('apps.voters-x', compact('voters'));
    }

    public function verify(Request $request)
    {
        // Hitung jumlah input yang diberikan
        $matches = 0;
        if ($request->filled('email')) $matches++;
        if ($request->filled('phone')) $matches++;
        if ($request->filled('code')) $matches++;

        if ($matches < 3) {
            return response()->json([
                'status' => 'not_enough_data',
                'message' => 'Minimal tiga data harus diisi.'
            ]);
        }

        // Jalankan query pencocokan
        $voter = Voter::where(function ($query) use ($request) {
            if ($request->filled('email')) {
                $query->where('email', $request->email);
            }
            if ($request->filled('phone')) {
                $query->where('phone', $request->phone);
            }
            if ($request->filled('code')) {
                $query->where('code', $request->code);
            }
        })->first(); // Ambil data pertama yang cocok dengan semua field yang diisi

        // Cek hasil
        if (!$voter) {
            return response()->json(['status' => 'not_found']);
        }

        if ($voter->status === 'voted') {
            return response()->json([
                'status' => 'already_voted',
                'voted_at' => $voter->updated_at->format('d M Y')
            ]);
        }

        // Simpan voter_id di session
        session(['voter_id' => $voter->id]);

        return response()->json(['status' => 'found']);
    }

    public function vote(Request $request)
    {
        $voter_id = session('voter_id');

        if (!$voter_id) {
            return response()->json(['status' => 'failed']);
        }

        $voter = Voter::find($voter_id);

        if ($voter && $voter->status == 'not_voted') {
            Vote::create([
                'voter_id' => $voter->id,
                'candidate_id' => $request->candidate_id,
                'voted_at' => now(),
            ]);

            $voter->update(['status' => 'voted']);

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);
    }

    
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $import = new VotersImport;
        Excel::import($import, $request->file('excel_file'));

        $imported = $import->getImportedCount();
        $skipped  = $import->getSkippedCount();

        if ($imported > 0 && $skipped > 0) {
            Session::flash('swal', [
                'type' => 'warning',
                'title' => 'Import Selesai Sebagian!',
                'text' => "$imported data diimport. $skipped baris dilewati karena duplikat.",
            ]);
        } elseif ($imported > 0) {
            Session::flash('swal', [
                'type' => 'success',
                'title' => 'Import Berhasil!',
                'text' => "$imported data voters berhasil diimport.",
            ]);
        } else {
            Session::flash('swal', [
                'type' => 'error',
                'title' => 'Gagal Mengimpor!',
                'text' => 'Tidak ada data baru yang diimpor.',
            ]);
        }

        return redirect()->back();
    }

    public function export(Request $request)
    {
        // Validasi input status pemilih
        $request->validate([
            'voter_status' => 'required|in:voted,not_voted',
        ]);

        // Ekspor data berdasarkan status
        return Excel::download(new VotersExport($request->voter_status), 'voters_' . $request->voter_status . '.xlsx');
    }

    public function deleteAll(Request $request)
    {
        try {
            Voter::query()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Semua data voters dan votes berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.'.$e->getMessage()
            ]);
        }
    }
}
