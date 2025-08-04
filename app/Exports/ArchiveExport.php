<?php

namespace App\Exports;

use App\Models\Archive;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArchiveExport implements FromQuery, WithHeadings, WithStyles, WithEvents, WithMapping
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    // PERUBAHAN: gunakan FromQuery, bukan FromCollection
    public function query()
    {
        $query = Archive::query()->with([
            'work_team_classification',
            'archive_type',
            'archive_status',
            'storage_location',
            'storage_place',
            'shelf_row',
            'box',
            'folder'
        ]);

        // DIPINDAHKAN dari collection()
        if (!empty($this->filters['text_search'])) {
            $query->where('archive_description', 'like', '%' . $this->filters['text_search'] . '%');
        }

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        if (!empty($this->filters['archive_type'])) {
            $query->where('archive_type_id', $this->filters['archive_type']);
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

        return $query;
    }

    // PERUBAHAN: ganti dari map() di collection() ke method map() untuk WithMapping
    public function map($item): array
    {
        static $index = 0;
        $index++;

        return [
            $index,
            $item->work_team_classification->code ?? '-',
            $item->archive_description ?? '-',
            $item->archive_lifespan ?? '-',
            $item->archive_status->name ?? '-',
            $item->storage_location->name ?? '-',
            $item->storage_place->name ?? '-',
            $item->shelf_row->name ?? '-',
            $item->folder->name ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            // Baris pertama
            ['No', 'Kode Klasifikasi', 'Uraian Arsip', 'Kurun Waktu', 'Status Arsip', 'Lokasi Penyimpanan', '', '', '', ''],
            // Baris kedua
            ['', '', '', '', '', 'Lokasi Penyimpanan Arsip', 'Tempat Penyimpanan Arsip', 'Baris', 'Boks', 'Folder'],
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

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $cellRange = "A1:{$highestColumn}{$highestRow}";

                $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }
}
