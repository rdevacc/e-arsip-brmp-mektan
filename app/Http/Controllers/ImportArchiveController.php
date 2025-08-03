<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Archive;
use App\Models\ArchiveBox;
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

class ImportArchiveController extends Controller
{
    public function index()
    {
        return view('apps.import-file-excel.index');
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,csv,xls|max:5120'
            ]);

            $path = $request->file('file')->store('uploads');
            $fullPath = storage_path('app/' . $path);

            Log::info('File uploaded for import', [
                'user_id' => auth()->id(),
                'filename' => $request->file('file')->getClientOriginalName(),
                'stored_path' => $path
            ]);

            $data = Excel::toArray([], $fullPath)[0];

            if (count($data) < 3) {
                Log::warning('Import failed: Data kurang dari 3 baris', [
                    'user_id' => auth()->id(),
                    'path' => $path,
                ]);

                return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
            }

            $insertData = [];
            $this->lookupCache = [];
            $errorLogs = [];

            foreach (array_slice($data, 2) as $rowIndex => $row) {
                if (!isset($row[0]) || trim((string)$row[0]) == '') {
                    Log::info("Baris ke-" . ($rowIndex + 3) . " dilewatkan karena kosong");
                    continue;
                }

                $jumlah = null;
                $kuantitasUnitId = null;
                if (isset($row[8]) && $this->toNull($row[8])) {
                    preg_match('/(\d+)\s*(.*)/', $row[8], $matches);
                    $jumlah = isset($matches[1]) ? (int)$matches[1] : null;
                    $kuantitasUnitId = $this->getId(ArchiveQuantityUnit::class, $this->toNull($matches[2] ?? null));
                }

                $storagePlaceName = $this->toNull($row[12] ?? null);
                $shelfRowName = $this->toNull($row[13] ?? null);
                $boxName = $this->toNull($row[14] ?? null);

                $storagePlaceId = $this->getModelId(ArchiveStoragePlace::class, $storagePlaceName);
                if (!$storagePlaceId && $storagePlaceName) {
                    $message = "Tempat Penyimpanan '$storagePlaceName' tidak ditemukan (baris " . ($rowIndex + 3) . ")";
                    $errorLogs[] = "Baris " . ($rowIndex + 3) . ": $message";
                    Log::warning($message);
                }

                $shelfRowId = null;
                if ($storagePlaceId && $shelfRowName) {
                    $shelfRowId = $this->getModelId(ArchiveShelfRow::class, $shelfRowName, [
                        'archive_storage_place_id' => $storagePlaceId,
                    ]);

                    if (!$shelfRowId) {
                        $message = "Rak '$shelfRowName' tidak ditemukan di Tempat Penyimpanan ID $storagePlaceId (baris " . ($rowIndex + 3) . ")";
                        $errorLogs[] = "Baris " . ($rowIndex + 3) . ": $message";
                        Log::warning($message);
                    }
                }

                $boxId = null;
                if ($shelfRowId && $boxName) {
                    $boxId = $this->getModelId(ArchiveBox::class, $boxName, [
                        'archive_shelf_row_id' => $shelfRowId,
                    ]);

                    if (!$boxId) {
                        $message = "Box '$boxName' tidak ditemukan di Rak ID $shelfRowId (baris " . ($rowIndex + 3) . ")";
                        $errorLogs[] = "Baris " . ($rowIndex + 3) . ": $message";
                        Log::warning($message);
                    }
                }

                $insertData[] = [
                    'user_id' => auth()->id() ?? 1,
                    'work_unit_id' => 1,
                    'work_team_classification_id' => $this->getId(WorkTeamClassification::class, $this->toNull($row[2] ?? null), 'code'),
                    'archive_description' => $this->toNull($row[3] ?? null),
                    'archive_lifespan' => $this->toNull($row[4] ?? null),
                    'archive_development_level_id' => $this->getId(ArchiveDevelopmentLevel::class, $this->toNull($row[5] ?? null)),
                    'archive_media_id' => $this->getId(ArchiveMedia::class, $this->toNull($row[6] ?? null)),
                    'archive_number' => $jumlah,
                    'archive_quantity_unit_id' => $kuantitasUnitId,
                    'period_id' => $this->getId(Period::class, $this->toNull($row[9] ?? null)),
                    'year_period' => $this->toNull($row[10] ?? null),
                    'archive_storage_location_id' => $this->getId(ArchiveStorageLocation::class, $this->toNull($row[11] ?? null)),
                    'archive_storage_place_id' => $storagePlaceId,
                    'archive_shelf_row_id' => $shelfRowId,
                    'archive_box_id' => $boxId,
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

                Log::info('Berhasil insert data arsip', [
                    'user_id' => auth()->id(),
                    'jumlah_data' => count($insertData),
                    'error_logs' => $errorLogs,
                ]);
            }

            Storage::delete($path);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupload dan diproses',
                'errors' => $errorLogs,
                'redirect' => route('archive-index')
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal upload file arsip', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengunggah file']);
        }
    }


    private $lookupCache = [];

    private function toNull($value)
    {
        if (is_null($value)) return null;
        $value = trim((string)$value);
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

        $id = $model::whereRaw("LOWER(TRIM($column)) = ?", [strtolower(trim($value))])->value('id');
        $this->lookupCache[$cacheKey] = $id;

        return $id;
    }

    private function getModelId(string $modelClass, ?string $name, array $filters = []): ?int
    {
        $name = $this->toNull($name);
        if (is_null($name)) return null;

        $cacheKey = $modelClass . ':' . $name . ':' . md5(json_encode($filters));
        if (isset($this->lookupCache[$cacheKey])) {
            return $this->lookupCache[$cacheKey];
        }

        $query = $modelClass::query()
            ->whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($name))]);

        foreach ($filters as $column => $value) {
            $query->where($column, $value);
        }

        $id = $query->value('id');
        $this->lookupCache[$cacheKey] = $id;

        return $id;
    }
}
