<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Election;
use App\Models\Voter;
use App\Jobs\SendWhatsappReminder;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule a job to send WhatsApp reminders every minute
Schedule::call(function () {
    $today = now()->startOfDay();
    $todayPlus3 = now()->copy()->addDays(3)->startOfDay();

    $elections = Election::whereBetween('start_time', [$today, $today->copy()->endOfDay()])
        ->orWhereBetween('start_time', [$todayPlus3, $todayPlus3->copy()->endOfDay()])
        ->get();

    if ($elections->isEmpty()) {
        Log::info('⏱ [WA Reminder] Tidak ada election yang dijadwalkan hari ini atau H-3.');
        return;
    }

    foreach ($elections as $election) {
        $voters = Voter::where('status', 'not_voted')->get();

        if ($voters->isEmpty()) {
            Log::info("⏱ [WA Reminder] Tidak ada voter 'not_voted' untuk election: {$election->id}");
            continue;
        }

        foreach ($voters as $index => $voter) {
            $message = "Test message for {$voter->name}. Election ID: {$election->id}";

            // Kirim job dengan delay agar tidak overload gateway
            SendWhatsappReminder::dispatch($voter, $message)->delay(now()->addSeconds($index * 20));
        }
        // foreach ($voters as $index => $voter) {
        //     if ($election->start_time->isSameDay($todayPlus3)) {
        //         $message = "Yth. {$voter->name}\n\n" .
        //             "Salam sehat dan harmonis,\n\n" .
        //             "Pemira ILUNI FKM UI 2025–2028 akan dibuka dalam 3 hari.\n" .
        //             "Pastikan Bapak/Ibu berpartisipasi dan menggunakan hak pilih sesuai jadwal yang telah ditentukan.\n\n" .
        //             "📅 Periode Voting: {$election->start_time->format('d M Y H:i')} s/d {$election->end_time->format('d M Y H:i')}\n\n" .
        //             "Salam hormat,\nPanitia Pemira ILUNI FKM UI";
        //     } elseif ($election->start_time->isSameDay($today)) {
        //         $message = "Yth. {$voter->name}\n\n" .
        //             "Salam sehat dan harmonis,\n\n" .
        //             "Hari ini Pemira ILUNI FKM UI 2025–2028 resmi dibuka.\n" .
        //             "Segera gunakan hak pilih Bapak/Ibu untuk menentukan arah ILUNI yang demokratis dan berintegritas.\n\n" .
        //             "📅 Batas Akhir Voting: {$election->end_time->format('d M Y H:i')}\n\n" .
        //             "Salam hormat,\nPanitia Pemira ILUNI FKM UI";
        //     } else {
        //         continue;
        //     }

        //     // Kirim job dengan delay agar tidak overload gateway
        //     SendWhatsappReminder::dispatch($voter, $message)->delay(now()->addSeconds($index * 3));
        // }

        Log::info("[WA Reminder] Kirim reminder ke {$voters->count()} voter untuk election {$election->id}");
    }
})->everyMinute();



