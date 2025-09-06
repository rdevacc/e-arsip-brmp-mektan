<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Archive;
use App\Models\ArchiveBox;
use App\Models\ArchiveCondition;
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
            $warnings = [];

            foreach (array_slice($data, 2) as $rowIndex => $row) {
                $baris = $rowIndex + 3;

                if (!isset($row[0]) || trim((string)$row[0]) == '') {
                    Log::info("Baris ke-$baris dilewatkan karena kosong");
                    continue;
                }

                // Parsing jumlah dan unit
                [$jumlah, $kuantitasUnitId] = $this->parseJumlahDanUnit($row[8] ?? null);

                // Validasi kolom terkait lokasi penyimpanan
                $storagePlaceId = $this->validateModel(ArchiveStoragePlace::class, $this->toNull($row[12] ?? null), "Tempat Penyimpanan", $baris, $errorLogs);
                $shelfRowId     = $this->validateModel(ArchiveShelfRow::class, $this->toNull($row[13] ?? null), "Rak", $baris, $errorLogs, ['archive_storage_place_id' => $storagePlaceId]);
                $boxId          = $this->validateModel(ArchiveBox::class, $this->toNull($row[14] ?? null), "Box", $baris, $errorLogs, ['archive_shelf_row_id' => $shelfRowId]);

                 // Validasi semua kolom lain
                $workTeamClassificationId = $this->validateModel(WorkTeamClassification::class, $this->toNull($row[2] ?? null), "Klasifikasi Tim Kerja", $baris, $errorLogs, [], 'code');
                $archiveDevelopmentLevelId = $this->validateModel(ArchiveDevelopmentLevel::class, $this->toNull($row[5] ?? null), "Tingkat Perkembangan Arsip", $baris, $errorLogs);
                $archiveMediaId = $this->validateModel(ArchiveMedia::class, $this->toNull($row[6] ?? null), "Media Arsip", $baris, $errorLogs);
                $archiveConditionId = $this->validateModel(ArchiveCondition::class, $this->toNull($row[7] ?? null), "Kondisi Arsip", $baris, $errorLogs);
                $periodId = $this->validateModel(Period::class, $this->toNull($row[9] ?? null), "Periode", $baris, $errorLogs);
                $archiveStorageLocationId = $this->validateModel(ArchiveStorageLocation::class, $this->toNull($row[11] ?? null), "Lokasi Penyimpanan", $baris, $errorLogs);
                $archiveFolderId = $this->validateModel(ArchiveFolder::class, $this->toNull($row[15] ?? null), "Folder", $baris, $errorLogs);
                $archiveTypeId = $this->validateModel(ArchiveType::class, $this->toNull($row[16] ?? null), "Tipe Arsip", $baris, $errorLogs);
                $archiveSubTypeId = $this->validateModel(ArchiveSubType::class, $this->toNull($row[17] ?? null), "Sub Tipe Arsip", $baris, $errorLogs);
                $archiveStatusId = $this->validateModel(ArchiveStatus::class, $this->toNull($row[18] ?? null), "Status Arsip", $baris, $errorLogs);

                $insertData[] = [
                    'user_id' => auth()->id() ?? 1,
                    'work_unit_id' => 1,
                    'work_team_classification_id' => $workTeamClassificationId,
                    'archive_description' => $this->toNull($row[3] ?? null),
                    'archive_lifespan' => $this->toNull($row[4] ?? null),
                    'archive_development_level_id' => $archiveDevelopmentLevelId,
                    'archive_media_id' => $archiveMediaId,
                    'archive_condition_id' => $archiveConditionId,
                    'archive_number' => $jumlah,
                    'archive_quantity_unit_id' => $kuantitasUnitId,
                    'period_id' => $periodId,
                    'year_period' => $this->toNull($row[10] ?? null),
                    'archive_storage_location_id' => $archiveStorageLocationId,
                    'archive_storage_place_id' => $storagePlaceId,
                    'archive_shelf_row_id' => $shelfRowId,
                    'archive_box_id' => $boxId,
                    'archive_folder_id' => $archiveFolderId,
                    'archive_type_id' => $archiveTypeId,
                    'archive_subtype_id' => $archiveSubTypeId,
                    'archive_status_id' => $archiveStatusId,
                    'archive_input_date' => now()->format('Y-m-d'),
                    'created_by' => auth()->id() ?? 1,
                    'updated_by' => auth()->id() ?? 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Stop insert kalau ada error di keseluruhan proses
            if (!empty($errorLogs)) {
                Storage::delete($path);
                return response()->json([
                    'success' => false,
                    'message' => 'Terdapat error pada data, upload dibatalkan.',
                    'errors' => $errorLogs
                ]);
            }

            if (!empty($warnings)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Upload dibatalkan karena ada data yang tidak valid',
                    'warnings' => $warnings
                ], 422);
            }

            $totalInserted = 0;
            // Insert Data
            if (count($insertData) > 0) {
                $batchSize = 200; // aman untuk banyak kolom
                $chunks = array_chunk($insertData, $batchSize);


                foreach ($chunks as $chunkIndex => $chunk) {
                    try {
                        Archive::insert($chunk);    
                        $totalInserted += count($chunk);
                        Log::info("Berhasil insert batch {$chunkIndex}", [
                            'user_id' => auth()->id(),
                            'jumlah_data' => count($chunk),
                        ]);
                    } catch (\Throwable $e) {
                       Log::error("Gagal insert batch {$chunkIndex}", [
                            'user_id' => auth()->id(),
                            'error' => $e->getMessage(),
                        ]);

                        Storage::delete($path);

                        return response()->json([
                            'success' => false,
                            'message' => "Gagal upload pada batch {$chunkIndex}",
                            'errors' => [$e->getMessage()]
                        ], 500);
                    }
                }
            }

            Storage::delete($path);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupload dan diproses',
                'total_baris' => count($data) - 2,
                'jumlah_data_terinsert' => $totalInserted,
                'errors' => $errorLogs ?? [],
                'redirect' => route('archive-index')
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal upload file arsip', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengunggah file',
                'errors' => !empty($errorLogs) ? $errorLogs : [$e->getMessage()]
            ], 500);
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

    private function getModelId(string $modelClass, ?string $name, array $filters = [], string $column = 'name'): ?int
    {
        $name = $this->toNull($name);
        if (is_null($name)) return null;

        $cacheKey = $modelClass . ':' . $column . ':' . $name . ':' . md5(json_encode($filters));
        if (isset($this->lookupCache[$cacheKey])) {
            return $this->lookupCache[$cacheKey];
        }

        $query = $modelClass::query()
            ->whereRaw("LOWER(TRIM($column)) = ?", [strtolower(trim($name))]);

        foreach ($filters as $col => $val) {
            $query->where($col, $val);
        }

        $id = $query->value('id');
        $this->lookupCache[$cacheKey] = $id;

        return $id;
    }

    private function parseJumlahDanUnit($value)
    {
        $jumlah = null;
        $kuantitasUnitId = null;

        if ($this->toNull($value)) {
            preg_match('/(\d+)\s*(.*)/', $value, $matches);
            $jumlah = isset($matches[1]) ? (int)$matches[1] : null;
            $kuantitasUnitId = $this->getId(ArchiveQuantityUnit::class, $this->toNull($matches[2] ?? null));
        }

        return [$jumlah, $kuantitasUnitId];
    }

    private function validateModel($modelClass, $value, $label, $baris, &$errorLogs, $where = [], $column = 'name')
    {
        if (!$value) {
            return null;
        }

        $id = $this->getModelId($modelClass, $value, $where, $column);

        if (!$id) {
            $message = "$label '$value' tidak ditemukan (baris $baris)";
            $errorLogs[] = "Baris $baris: $message";
            Log::warning($message);
        }

        return $id;
    }

}
