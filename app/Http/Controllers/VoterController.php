<?php

namespace App\Http\Controllers;

use App\Exports\VotersExport;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Http\Request;
use App\Imports\VotersImport;
use App\Models\Election;
use App\Services\WhatsappService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class VoterController extends Controller
{
    public function index()
    {
        // Logic to display a list of voters
        $candidates = Candidate::orderBy('candidate_number', 'asc')->get();
        $election = Election::first(); // Ambil election pertama (jika ada)
        
        return view('apps.voters', compact('candidates','election'));
    }

    public function admin()
    {
        // Logic to display a list of voters
        $voters = Voter::orderBy('created_at', 'desc')->get();
        $election = Election::first(); // Ambil election pertama (jika ada)
        return view('apps.voters-x', compact('voters','election'));
    }

    public function verify(Request $request)
    {
        // Hitung jumlah input yang diberikan
        $matches = 0;
        // if ($request->filled('email')) $matches++;
        if ($request->filled('phone')) $matches++;
        if ($request->filled('code')) $matches++;

        if ($matches < 2) {
            return response()->json([
                'status' => 'not_enough_data',
                'message' => 'Minimal dua data harus diisi.'
            ]);
        }

        // Jalankan query pencocokan
        $voter = Voter::where(function ($query) use ($request) {
            // if ($request->filled('email')) {
            //     $query->where('email', $request->email);
            // }
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
        $election = Election::first();

        if (!$election || $election->status !== 'Y') {
            return response()->json([
            'status' => 'failed',
            'message' => 'Pemilihan belum dimulai atau tidak tersedia.'
            ]);
        }

        if ($election->end_time && now()->greaterThan($election->end_time)) {
            return response()->json([
            'status' => 'failed',
            'message' => 'Pemilihan telah berakhir.'
            ]);
        }

        $voter_id = session('voter_id');

        if (!$voter_id) {
            return response()->json(['status' => 'failed']);
        }

        $voter = Voter::find($voter_id);

        if ($voter && $voter->status == 'not_voted') {
            // Simpan vote
            Vote::create([
                'voter_id'     => $voter->id,
                'candidate_id' => $request->candidate_id,
                'voted_at'     => now(),
            ]);

            // Update status voter
            $voter->update(['status' => 'voted']);

            // Kirim pesan WA setelah vote
            $message = "Dear {$voter->name},\n\n" .
                "Greetings,\n\n" .
                "We sincerely thank you for participating in the ILUNI FKM UI 2025–2028 election. Your involvement reflects a strong commitment to upholding democracy and the integrity of our organization.\n\n" .
                "Below are the details of your participation in the voting process:\n\n" .
                "• Full Name   : {$voter->name}\n" .
                "• Active Email: {$voter->email}\n" .
                "• Contact No. : {$voter->phone}\n\n" .
                "Your contribution is highly valued in fostering a harmonious, democratic, and integrity-driven ILUNI FKM UI. We hope this step will lead to meaningful progress for our collective future.\n\n" .
                "Kind regards,\n\n" .
                "The Committee of ILUNI FKM UI 2025–2028 Election and General Assembly\n\n" .
                "📧 Email: xx@gmail.com\n" .
                "📱 WhatsApp: wa.me/xxx";

            // $message = "Yth. {$voter->name},\n\n" .
            //     "Salam sehat dan harmonis,\n\n" .
            //     "Terima kasih telah menggunakan hak suara Anda dalam Pemira ILUNI FKM UI 2025–2028. Partisipasi Anda adalah wujud nyata dari komitmen terhadap demokrasi dan integritas organisasi kita.\n\n" .
            //     "Berikut adalah data partisipasi Anda dalam proses pemungutan suara:\n\n" .
            //     "• Nama Lengkap : {$voter->name}\n" .
            //     "• Email Aktif  : {$voter->email}\n" .
            //     "• Nomor Kontak : {$voter->phone}\n\n" .
            //     "Kami sangat menghargai kontribusi Anda dalam mewujudkan ILUNI FKM UI yang harmonis, demokratis, dan berintegritas. Semoga langkah kecil ini membawa dampak besar bagi kemajuan bersama.\n\n" .
            //     "Salam hormat,\n\n" .
            //     "Panitia Pemira dan MUBES ILUNI FKM UI 2025–2028\n\n" .
            //     "📧 Email: xx@gmail.com\n" .
            //     "📱 WhatsApp: wa.me/xxx";

            // Kirim ke WhatsApp
            app(WhatsappService::class)->sendFromVoter($voter, $voter->phone, $message);

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
