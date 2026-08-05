<?php

namespace App\Imports;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ChunkReadFilter implements IReadFilter
{
    /**
     * Baris awal yang akan dibaca.
     *
     * @var int
     */
    private int $startRow = 0;

    /**
     * Baris akhir yang akan dibaca.
     *
     * @var int
     */
    private int $endRow = 0;

    /**
     * Mengatur rentang baris yang akan dibaca.
     *
     * @param int $startRow
     * @param int $chunkSize
     * @return void
     */
    public function setRows(int $startRow, int $chunkSize): void
    {
        $this->startRow = $startRow;
        $this->endRow = $startRow + $chunkSize - 1;
    }

    /**
     * Menentukan apakah cell perlu dibaca.
     *
     * Header (baris 1-2) selalu dibaca.
     *
     * @param string $column
     * @param int $row
     * @param string $worksheetName
     * @return bool
     */
    public function readCell($column, $row, $worksheetName = ''): bool
    {
        /*
        * Hanya baca kolom A sampai T
        */
        if ($column > 'T') {
            return false;
        }

        /*
        * Header selalu dibaca
        */
        if ($row <= 2) {
            return true;
        }

        /*
        * Hanya baca baris dalam chunk
        */
        return $row >= $this->startRow
            && $row <= $this->endRow;
    }
}