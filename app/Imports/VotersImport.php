<?php

namespace App\Imports;

use App\Models\Voter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class VotersImport implements ToCollection, WithHeadingRow
{
    protected $imported = 0;
    protected $skipped = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $exists = Voter::where('email', $row['email'])
                        ->orWhere('phone', $row['phone'])
                        ->orWhere('id_card_number', $row['id_card_number'])
                        ->exists();

            if ($exists) {
                $this->skipped++;
                continue;
            }

            Voter::create([
                'name'       => $row['name'],
                'email'      => $row['email'],
                'phone'      => $row['phone'],
                'id_card_number'=> $row['id_card_number'],
                'birth_date' => is_numeric($row['birth_date'])
                                ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birth_date'])
                                : Carbon::parse($row['birth_date']),
                'status'     => 'not_voted',
            ]);

            $this->imported++;
        }
    }

    public function getImportedCount()
    {
        return $this->imported;
    }

    public function getSkippedCount()
    {
        return $this->skipped;
    }
}
