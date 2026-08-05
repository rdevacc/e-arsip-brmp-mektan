<?php

namespace App\Services;

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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ArchiveImportService
{
    protected $userId;

    protected $now;

    protected $lookupCache = [];

    protected array $masterData = [];

    protected $errorLogs = [];

    protected $warnings = [];

    protected $totalInserted = 0;

    protected $totalRows = 0;

    protected $batchSize = 200;

    protected $currentBatch = [];

    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->now = now();

        $this->loadMasterData();
    }

    private function loadMasterData(): void
    {
        $this->masterData['archive_type'] = ArchiveType::select('id', 'name')
            ->get()
            ->keyBy(function ($item) {
                return strtolower(trim($item->name));
            });

        $this->masterData['archive_status'] = ArchiveStatus::select('id', 'name')
            ->get()
            ->keyBy(function ($item) {
                return strtolower(trim($item->name));
            });
    }

    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }

    private function toNull($value)
    {
        if (is_null($value)) {
            return null;
        }

        $value = trim((string) $value);

        return ($value === '' || $value === '-') ? null : $value;
    }

    private function getId($model, $value, $column = 'name')
    {
        $value = $this->toNull($value);

        if (is_null($value)) {
            return null;
        }

        $cacheKey = $model . ':' . $column . ':' . $value;

        if (isset($this->lookupCache[$cacheKey])) {
            return $this->lookupCache[$cacheKey];
        }

        $id = $model::whereRaw(
            "LOWER(TRIM($column)) = ?",
            [strtolower(trim($value))]
        )->value('id');

        $this->lookupCache[$cacheKey] = $id;

        return $id;
    }

    private function getModelId(
        string $modelClass,
        ?string $name,
        array $filters = [],
        string $column = 'name'
    ): ?int {
        $name = $this->toNull($name);

        if (is_null($name)) {
            return null;
        }

        $cacheKey = $modelClass . ':' . $column . ':' . $name . ':' . md5(json_encode($filters));

        if (isset($this->lookupCache[$cacheKey])) {
            return $this->lookupCache[$cacheKey];
        }

        $query = $modelClass::query()
            ->whereRaw(
                "LOWER(TRIM($column)) = ?",
                [strtolower(trim($name))]
            );

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

            $jumlah = isset($matches[1])
                ? (int) $matches[1]
                : null;

            $kuantitasUnitId = $this->getId(
                ArchiveQuantityUnit::class,
                $this->toNull($matches[2] ?? null)
            );
        }

        return [$jumlah, $kuantitasUnitId];
    }

    private function validateModel(
        $modelClass,
        $value,
        $label,
        $baris,
        &$errorLogs,
        $where = [],
        $column = 'name'
    ) {
        if (!$value) {
            return null;
        }

        $id = $this->getModelId(
            $modelClass,
            $value,
            $where,
            $column
        );

        if (!$id) {

            $message = "$label '$value' tidak ditemukan (baris $baris)";

            $errorLogs[] = "Baris $baris: $message";

            Log::warning($message);
        }

        return $id;
    }

    public function getErrorLogs(): array
    {
        return $this->errorLogs;
    }

    public function getWarnings(): array
    {
        return $this->warnings;
    }

    public function getTotalInserted(): int
    {
        return $this->totalInserted;
    }

    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    public function processRow(array $row, int $baris): void
    {
        $this->totalRows++;

        if (!isset($row[0]) || trim((string) $row[0]) === '') {
            Log::info("Baris ke-$baris dilewatkan karena kosong");
            return;
        }

        // Parsing jumlah dan unit
        [$jumlah, $kuantitasUnitId] = $this->parseJumlahDanUnit($row[8] ?? null);

        // Validasi lokasi penyimpanan
        $storagePlaceId = $this->validateModel(
            ArchiveStoragePlace::class,
            $this->toNull($row[12] ?? null),
            "Tempat Penyimpanan",
            $baris,
            $this->errorLogs
        );

        $shelfRowId = $this->validateModel(
            ArchiveShelfRow::class,
            $this->toNull($row[13] ?? null),
            "Rak",
            $baris,
            $this->errorLogs,
            [
                'archive_storage_place_id' => $storagePlaceId
            ]
        );

        $boxId = $this->validateModel(
            ArchiveBox::class,
            $this->toNull($row[14] ?? null),
            "Box",
            $baris,
            $this->errorLogs,
            [
                'archive_shelf_row_id' => $shelfRowId
            ]
        );

        // Validasi master data
        $workTeamClassificationId = $this->validateModel(
            WorkTeamClassification::class,
            $this->toNull($row[2] ?? null),
            "Klasifikasi Tim Kerja",
            $baris,
            $this->errorLogs,
            [],
            'code'
        );

        $archiveDevelopmentLevelId = $this->validateModel(
            ArchiveDevelopmentLevel::class,
            $this->toNull($row[5] ?? null),
            "Tingkat Perkembangan Arsip",
            $baris,
            $this->errorLogs
        );

        $archiveMediaId = $this->validateModel(
            ArchiveMedia::class,
            $this->toNull($row[6] ?? null),
            "Media Arsip",
            $baris,
            $this->errorLogs
        );

        $archiveConditionId = $this->validateModel(
            ArchiveCondition::class,
            $this->toNull($row[7] ?? null),
            "Kondisi Arsip",
            $baris,
            $this->errorLogs
        );

        $periodId = $this->validateModel(
            Period::class,
            $this->toNull($row[9] ?? null),
            "Periode",
            $baris,
            $this->errorLogs
        );

        $archiveStorageLocationId = $this->validateModel(
            ArchiveStorageLocation::class,
            $this->toNull($row[11] ?? null),
            "Lokasi Penyimpanan",
            $baris,
            $this->errorLogs
        );

        $archiveFolderId = $this->validateModel(
            ArchiveFolder::class,
            $this->toNull($row[15] ?? null),
            "Folder",
            $baris,
            $this->errorLogs
        );

        $archiveTypeId = $this->validateModel(
            ArchiveType::class,
            $this->toNull($row[16] ?? null),
            "Tipe Arsip",
            $baris,
            $this->errorLogs
        );

        $archiveSubTypeId = $this->validateModel(
            ArchiveSubType::class,
            $this->toNull($row[17] ?? null),
            "Sub Tipe Arsip",
            $baris,
            $this->errorLogs
        );

        $archiveStatusId = $this->validateModel(
            ArchiveStatus::class,
            $this->toNull($row[18] ?? null),
            "Status Arsip",
            $baris,
            $this->errorLogs
        );

        $this->addInsertData([
            'user_id' => $this->userId,
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
            'archive_additional_information' => $this->toNull($row[19] ?? null),
            'archive_input_date' => $this->now->format('Y-m-d'),
            'created_by' => $this->userId,
            'updated_by' => $this->userId,
            'created_at' => $this->now,
            'updated_at' => $this->now,
        ]);
    }

    private function addInsertData(array $data): void
    {
        $this->currentBatch[] = $data;

        if (count($this->currentBatch) >= $this->batchSize) {
            $this->flush();
        }
    }

    public function flush(): void
    {
        if (empty($this->currentBatch)) {
            return;
        }

        if (!empty($this->errorLogs)) {
            $this->currentBatch = [];
            return;
        }

        try {

            Archive::insert($this->currentBatch);

            $this->totalInserted += count($this->currentBatch);

            Log::info('Berhasil insert batch', [
                'jumlah_data' => count($this->currentBatch)
            ]);

        } catch (\Throwable $e) {

            Log::error('Gagal insert batch', [
                'error' => $e->getMessage()
            ]);

            throw $e;
        }

        $this->currentBatch = [];
    }
}