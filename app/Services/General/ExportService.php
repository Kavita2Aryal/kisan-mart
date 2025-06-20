<?php

namespace App\Services\General;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PDF;

class ExportService
{
    public static function csv($data, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $csv_writer = new Csv($spreadsheet);
        
        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();
        
        foreach ($data['array_column_heading_names'] as $key => $name) {
            $activeSheet->setCellValue($key, $name);
        }
        
        if ($data['array'] != null) {
            foreach ($data['array'] as $row) {
                foreach ($row as $key => $value) {
                    $activeSheet->setCellValue($key , $value);
                }
            }
        }
        
        $filename = $filename.'-'.now()->format('Y-m-d-H-i-s').'.csv';
        if (!file_exists('files')) mkdir('files', 0755);
        $csv_writer->save(storage_path("app/public/csv/{$filename}"));

        return response()
                ->download(storage_path("app/public/csv/{$filename}"))
                ->deleteFileAfterSend(true);
    }

    public static function pdf($data, $filename, $template)
    {
        return PDF::loadView('pdf.'.$template, ['data' => $data])
                ->download($filename.'-'.now()->format('Y-m-d-H-i-s').'.pdf');
    }
}