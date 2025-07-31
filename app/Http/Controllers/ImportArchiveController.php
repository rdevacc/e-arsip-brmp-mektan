<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Archive;
use App\Models\ArchiveBox;
use App\Models\ArchiveBuilding;
use App\Models\ArchiveDevelopmentLevel;
use App\Models\ArchiveFolder;
use App\Models\ArchiveMedia;
use App\Models\ArchiveQuantityUnit;
use App\Models\ArchiveShelfRow;
use App\Models\ArchiveStatus;
use App\Models\ArchiveStorageLocation;
use App\Models\ArchiveStoragePlace;
use App\Models\ArchiveSubType;
use App\Models\ArchiveType;
use App\Models\Period;
use App\Models\WorkTeamClassification;
use Illuminate\Support\Facades\Storage;

class ImportArchiveController extends Controller
{
    public function index(){
        return view('apps.import-file-excel.index');
    }
    
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:5120'
        ]);

        $path = $request->file('file')->store('uploads');
        $fullPath = storage_path('app/' . $path);

        $data = Excel::toArray([], $fullPath)[0];

        if (count($data) < 3) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        $insertData = [];
        $this->lookupCache = []; // Reset cache setiap kali proses upload

        // Loop data mulai dari baris ke-3 (indeks 2)
        foreach (array_slice($data, 2) as $row) {
            if (!isset($row[0]) || trim((string)$row[0]) == '') continue; // Lewatkan baris kosong

            // Ambil nilai jumlah & kuantitas unit
            $jumlah = null;
            $kuantitasUnitId = null;
            if (isset($row[8]) && $this->toNull($row[8])) {
                preg_match('/(\d+)\s*(.*)/', $row[8], $matches);
                $jumlah = isset($matches[1]) ? (int)$matches[1] : null;
                $kuantitasUnitId = $this->getId(ArchiveQuantityUnit::class, $this->toNull($matches[2] ?? null));
            }

            $insertData[] = [
                'user_id' => 1,
                'work_unit_id' => 1,
                'work_team_classification_id' => $this->getId(WorkTeamClassification::class, $this->toNull($row[2] ?? null), 'code'), // Kode Klasifikasi
                'archive_description' => $this->toNull($row[3] ?? null), // Uraian
                'archive_lifespan' => $this->toNull($row[4] ?? null), // Kurun Waktu
                'archive_development_level_id' => $this->getId(ArchiveDevelopmentLevel::class, $this->toNull($row[5] ?? null)), // Tingkat Perkembangan
                'archive_media_id' => $this->getId(ArchiveMedia::class, $this->toNull($row[6] ?? null)), // Media Arsip
                'archive_number' => $jumlah,
                'archive_quantity_unit_id' => $kuantitasUnitId,
                'period_id' => $this->getId(Period::class, $this->toNull($row[9] ?? null)), // Periode
                'year_period' => $this->toNull($row[10] ?? null),
                'archive_storage_location_id' => $this->getId(ArchiveStorageLocation::class, $this->toNull($row[11] ?? null)),
                'archive_storage_place_id' => $this->getId(ArchiveStoragePlace::class, $this->toNull($row[12] ?? null)),
                'archive_shelf_row_id' => $this->getId(ArchiveShelfRow::class, $this->toNull($row[13] ?? null)),
                'archive_box_id' => $this->getId(ArchiveBox::class, $this->toNull($row[14] ?? null)),
                'archive_folder_id' => $this->getId(ArchiveFolder::class, $this->toNull($row[15] ?? null)),
                'archive_type_id' => $this->getId(ArchiveType::class, $this->toNull($row[16] ?? null)),
                'archive_subtype_id' => $this->getId(ArchiveSubType::class, $this->toNull($row[17] ?? null)),
                'archive_status_id' => $this->getId(ArchiveStatus::class, $this->toNull($row[18] ?? null)),
                'archive_input_date' => now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (count($insertData) > 0) {
            Archive::insert($insertData);
        }

        // Hapus file setelah diproses
        Storage::delete($path);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupload dan diproses',
            'redirect' => route('archive-index')
        ]);
    }

    private $lookupCache = []; // Tempat cache lokal lookup

    private function toNull($value)
    {
        if (is_null($value)) return null;
        $value = trim((string)$value); // Cast ke string untuk hindari warning
        return ($value === '' || $value === '-') ? null : $value;
    }

    private function getId($model, $value, $column = 'name')
    {
        $value = $this->toNull($value);
        if (is_null($value)) return null;

        $cacheKey = $model . ':' . $column . ':' . $value;

        if (isset($this->lookupCache[$cacheKey])) {
            return $this->lookupCache[$cacheKey];
        }

        $id = $model::where($column, $value)->value('id');
        $this->lookupCache[$cacheKey] = $id;

        return $id;
    }
}
