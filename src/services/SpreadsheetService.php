<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpreadsheetService {
    
    public function make(array $data) {
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("My Excel");

        $header = array_keys($data[0]);

        $sheet->fromArray($header, "NULL", "A1");

        $sheet->fromArray($data, "NULL", "A2");

        // $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');
        ob_end_clean();
        return $writer->save('php://output');
    }
}