<?php

namespace App\Exports;

use App\Models\Archive;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArchiveExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Archive::with([
            'work_team_classification',
            'archive_status',
            'building',
            'cabinet',
            'shelf',
            'shelf_row',
            'folder'
        ]);

        if (!empty($this->filters['text_search'])) {
            $query->where('archive_description', 'like', '%' . $this->filters['text_search'] . '%');
        }

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        if (!empty($this->filters['archive_status'])) {
            $query->where('archive_status_id', $this->filters['archive_status']);
        }

        if (!empty($this->filters['classification'])) {
            $query->where('work_team_classification_id', $this->filters['classification']);
        }

        if (!empty($this->filters['lifespan'])) {
            $query->where('archive_lifespan', $this->filters['lifespan']);
        }

        return $query->get()->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'classification_code' => $item->work_team_classification->code ?? '-',
                'description' => $item->archive_description ?? '-',
                'lifespan' => $item->archive_lifespan ?? '-',
                'status' => $item->archive_status->name ?? '-',
                'building' => $item->building->name ?? '-',
                'cabinet' => $item->cabinet->name ?? '-',
                'shelf' => $item->shelf->name ?? '-',
                'shelf_row' => $item->shelf_row->name ?? '-',
                'folder' => $item->folder->name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            // Baris pertama
            ['No', 'Kode Klasifikasi', 'Uraian Arsip', 'Kurun Waktu', 'Status Arsip', 'Lokasi Penyimpanan', '', '', '', ''],
            // Baris kedua
            ['', '', '', '', '', 'Gedung', 'Lemari', 'Rak', 'Baris', 'Folder'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Gabung sel
        $sheet->mergeCells('A1:A2');
        $sheet->mergeCells('B1:B2');
        $sheet->mergeCells('C1:C2');
        $sheet->mergeCells('D1:D2');
        $sheet->mergeCells('E1:E2');
        $sheet->mergeCells('F1:J1');

        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
            2 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center']],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tentukan area data (dari A1 sampai kolom terakhir dan baris terakhir)
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $cellRange = "A1:{$highestColumn}{$highestRow}";

                // Terapkan border ke seluruh tabel
                $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }
}

