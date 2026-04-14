<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AbsensiExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $data, $bulan, $tahun, $daysInMonth;

    public function __construct($data, $bulan, $tahun, $daysInMonth)
    {
        $this->data = $data;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->daysInMonth = $daysInMonth;
    }

    public function view(): View
    {
        return view('manager.export.absensi-excel', [
            'data' => $this->data,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'daysInMonth' => $this->daysInMonth
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Bold untuk baris 1 dan 2
        $sheet->getStyle('A1:AJ2')->getFont()->setBold(true);
        $highestRow = $sheet->getHighestRow();

        // UBAH DISINI: Loop data sekarang dimulai dari baris ke 3 ($row = 3)
        for ($row = 3; $row <= $highestRow; $row++) {
            for ($col = 3; $col <= (2 + $this->daysInMonth); $col++) { 
                $cell = $sheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                
                $color = 'E9ECEF'; // Abu-abu
                if ($val == 'A') $color = '198754'; // Hijau 
                elseif ($val == 'M') $color = 'DC3545'; // Merah 
                elseif ($val == 'I') $color = 'FD7E14'; // Jingga 
                elseif ($val == 'L') $color = '0D6EFD'; // Biru 

                if ($val != '') {
                    $sheet->getStyleByColumnAndRow($col, $row)->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['argb' => 'FF' . $color]
                        ],
                        'font' => ['color' => ['argb' => 'FFFFFFFF'], 'bold' => true]
                    ]);
                }
            }
        }
    }
}