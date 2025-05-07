<?php

namespace App\Exports;

use App\Models\Voter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VotersExport implements FromCollection, WithHeadings
{
    protected $status;

    // Konstruktor untuk menerima status
    public function __construct($status)
    {
        $this->status = $status;
    }

    // Menentukan kolom-kolom yang akan diekspor
    public function headings(): array
    {
        return [
            'ID', 'Nama', 'Email', 'Phone', 'ID Card Number', 'Tanggal Lahir', 'Status'
        ];
    }

    // Mengambil data pemilih berdasarkan status
    public function collection()
    {
        return Voter::where('status', $this->status)->get([
            'id', 'name', 'email', 'phone', 'id_card_number', 'birth_date', 'status'
        ]);
    }
}
