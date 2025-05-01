<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Http\Request;
use App\Imports\VotersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

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
        $voter = Voter::where(function ($query) use ($request) {
            $matches = 0;

            if ($request->email) {
            $query->orWhere('email', $request->email);
            $matches++;
            }

            if ($request->id_university) {
            $query->orWhere('id_card_number', $request->id_university);
            $matches++;
            }

            if ($request->birth_date) {
            $query->orWhere('birth_date', $request->birth_date);
            $matches++;
            }

            if ($matches < 2) {
            return null; // Not enough matches
            }
        })->first();
        

        if (!$voter) {
            return response()->json(['status' => 'not_found', 'voter' => $voter]);
        }

        if ($voter->status == 'voted') {
            return response()->json(['status' => 'already_voted', 'voted_at' => $voter->updated_at->format('d M Y')]);
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

}
