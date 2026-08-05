<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Imports\ArchiveImport;

class ImportArchiveController extends Controller
{
    public function index()
    {
        return view('apps.import-file-excel.index');
    }


    public function upload(Request $request)
    {
        $path = null;

        try {

            $request->validate([
                'file' => 'required|mimes:xlsx,csv,xls|max:5120'
            ]);


            $path = $request->file('file')
                ->store('uploads');


            $fullPath = storage_path('app/' . $path);


            Log::info('File uploaded for import', [
                'user_id' => auth()->id(),
                'filename' => $request->file('file')->getClientOriginalName(),
                'stored_path' => $path
            ]);


            $import = new ArchiveImport(
                auth()->id() ?? 1
            );


            $import->import($fullPath);


            $errorLogs = $import->getErrorLogs();
            $warnings = $import->getWarnings();



            Storage::delete($path);



            if (!empty($errorLogs)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Terdapat error pada data, upload dibatalkan.',
                    'errors' => $errorLogs
                ], 422);
            }



            if (!empty($warnings)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Upload dibatalkan karena ada data yang tidak valid.',
                    'warnings' => $warnings
                ], 422);
            }



            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupload dan diproses.',
                'total_baris' => $import->getTotalRows(),
                'jumlah_data_terinsert' => $import->getTotalInserted(),
                'errors' => [],
                'redirect' => route('archive-index')
            ]);



        } catch (\Throwable $e) {


            if ($path && Storage::exists($path)) {
                Storage::delete($path);
            }


            Log::error('Gagal upload file arsip', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);


            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengunggah file.',
                'errors' => [
                    $e->getMessage()
                ]
            ], 500);
        }
    }
}