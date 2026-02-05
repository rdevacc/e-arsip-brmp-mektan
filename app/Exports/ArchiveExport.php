<?php

namespace App\Exports;

use App\Models\Archive;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArchiveExport implements FromQuery, WithHeadings, WithStyles, WithEvents, WithMapping, WithChunkReading
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    // PERUBAHAN: gunakan FromQuery, bukan FromCollection
    public function query()
    {
        $query = Archive::query()->with([
            'work_team_classification',
            'archive_type',
            'archive_subtype',
            'archive_development_level',
            'archive_media',
            'archive_condition',
            'archive_quantity_unit',
            'period',
            'archive_status',
            'archive_storage_location',
            'archive_storage_place',
            'archive_shelf_row',
            'archive_box',
            'archive_folder'
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
            $item->work_unit->name ?? '-',
            $item->work_team_classification->code ?? '-',
            $item->archive_description ?? '-',
            $item->archive_lifespan ?? '-',
            $item->archive_development_level->name ?? '-',
            $item->archive_media->name ?? '-',
            $item->archive_condition->name ?? '-',
            ($item->archive_number ?? '-') . ' ' . ($item->archive_quantity_unit->name ?? '-'),
            $item->period->name ?? '-',
            $item->year_period ?? '-',
            $item->archive_storage_location->name ?? '-',
            $item->archive_storage_place->name ?? '-',
            $item->archive_shelf_row->name ?? '-',
            $item->archive_box->name ?? '-',
            $item->archive_folder->name ?? '-',
            $item->archive_type->name ?? '-',
            $item->archive_subtype->name ?? '-',
            $item->archive_status->name ?? '-',
            $item->archive_additional_information ?? '-',
        ];
    }

    public function headings(): array
    {
       return [
            [ // Baris 1
                'No','Unit Kerja', 'Kode Klasifikasi', 'Uraian', 'Kurun Waktu',
                'Tingkat Perkembangan', 'Media Arsip', 'Kondisi', 'Jumlah',
                'Periode', 'Tahun Periode',
                'Lokasi Penyimpanan', '', '', '', '',
                'Jenis Arsip', 'Sub Jenis Arsip', 'Status', 'Keterangan Tambahan Arsip'
            ],
            [ // Baris 2
                '', '', '', '', '',
                '', '', '', '',
                '', '',
                'Lokasi Penyimpanan Arsip', 'Tempat Penyimpanan Arsip', 'Baris', 'Boks', 'Folder',
                '', '', ''
            ]
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
        $sheet->mergeCells('F1:F2');
        $sheet->mergeCells('G1:G2');
        $sheet->mergeCells('H1:H2');
        $sheet->mergeCells('I1:I2');
        $sheet->mergeCells('J1:J2');
        $sheet->mergeCells('K1:K2');
        $sheet->mergeCells('L1:P1');
        $sheet->mergeCells('Q1:Q2');
        $sheet->mergeCells('R1:R2');
        $sheet->mergeCells('S1:S2');
        $sheet->mergeCells('T1:T2');

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
