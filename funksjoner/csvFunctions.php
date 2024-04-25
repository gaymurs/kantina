<?php

class csvFunctions
{
    public static function csvToAsoArray($csvFilePath = 'data.csv')
    {
        $processedCsvArray = [];
        $rawCsvArray = [];
        $file = fopen($csvFilePath, "r");
        while (!feof($file)) {
            $rawCsvArray[] = fgetcsv($file);
        }
        foreach ($rawCsvArray as $columnKey => $column) {
            if ($columnKey === 0) continue;
            if ($column === false) continue;
            $processedCsvArray[$columnKey] = [];

            for ($rowKey = 0; $rowKey < count($column); $rowKey++) {
                $processedCsvArray[$columnKey][$rawCsvArray[0][$rowKey]] = $column[$rowKey];
            }

        }
        return $processedCsvArray;
    }

    public static function asoArrayToCsv(array $asoArray, $csvFilePath = 'output.csv')
    {
        $file = fopen($csvFilePath, 'w');

        // Write the header row
        $headers = [];
        foreach ($asoArray as $row) {
            $headers = array_merge($headers, array_keys($row));
        }
        $headers = array_unique($headers);

        // Write data rows
        $rowData = [];
        foreach ($asoArray as $key => $row) {
            $rowData[$key] = [];
            foreach ($headers as $header) {
                if (isset($row[$header])) $rowData[$key][] = $row[$header];
            }
        }
        $outputArray = array_merge([$headers], $rowData);
        foreach ($outputArray as $key => $fields) {
            fputcsv($file, $fields);
        }

        fclose($file);
    }
}