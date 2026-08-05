<?php

namespace App\Imports;

use App\Services\ArchiveImportService;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ArchiveImport
{
    protected ArchiveImportService $service;

    protected int $chunkSize = 200;

    public function __construct(int $userId)
    {
        $this->service = new ArchiveImportService($userId);
    }

    public function import(string $filePath): void
    {
        $reader = IOFactory::createReaderForFile($filePath);

        $reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);

        /*
        * Ambil jumlah baris terakhir
        */
        $spreadsheet = $reader->load($filePath);

        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestDataRow();

        $spreadsheet->disconnectWorksheets();

        unset($worksheet);
        unset($spreadsheet);

        gc_collect_cycles();


        $filter = null;

        $this->service->beginTransaction();

        try {

            for (
                $startRow = 3;
                $startRow <= $highestRow;
                $startRow += $this->chunkSize
            ) {

                $reader = IOFactory::createReaderForFile($filePath);

                $reader->setReadDataOnly(true);
                $reader->setReadEmptyCells(false);


                $filter = new ChunkReadFilter();

                $filter->setRows(
                    $startRow,
                    $this->chunkSize
                );

                $reader->setReadFilter($filter);


                $spreadsheet = $reader->load($filePath);

                $worksheet = $spreadsheet->getActiveSheet();


                $rows = $worksheet->rangeToArray(
                    "A{$startRow}:T" . min(
                        $startRow + $this->chunkSize - 1,
                        $highestRow
                    ),
                    null,
                    true,
                    false
                );

                foreach ($rows as $index => $rowData) {

                    $this->service->processRow(
                        $rowData,
                        $startRow + $index
                    );
                }


                $this->service->flush();


                $spreadsheet->disconnectWorksheets();

                unset($worksheet);
                unset($spreadsheet);

                gc_collect_cycles();
            }


            if (!empty($this->service->getErrorLogs())) {

                $this->service->rollback();

                return;
            }


            $this->service->commit();


        } catch (\Throwable $e) {

            $this->service->rollback();

            throw $e;
        }
    }

    public function getErrorLogs(): array
    {
        return $this->service->getErrorLogs();
    }

    public function getWarnings(): array
    {
        return $this->service->getWarnings();
    }

    public function getTotalInserted(): int
    {
        return $this->service->getTotalInserted();
    }

    public function getTotalRows(): int
    {
        return $this->service->getTotalRows();
    }
}