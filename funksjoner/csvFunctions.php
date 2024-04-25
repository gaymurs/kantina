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
                //var_dump($j);
                //echo "<br>";
                //if ($rowKey === 0) continue;
                $processedCsvArray[$columnKey][$rawCsvArray[0][$rowKey]] = $column[$rowKey];

/*                if (!isset($processedCsvArray[$i - 1])) {
                    $processedCsvArray[$i - 1] = [
                        $j[0] => $j[$i],
                    ];
                } else {
                    $processedCsvArray[$i - 1] += [$j[0] => $j[$i]];
                }*/
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
/*        var_dump($data);

        $transposedArray = array_map(null, ...$rowData);

        // Output array
        $outputArray = array_map(static function ($row) {
            return array_values($row);
        }, $transposedArray);

        foreach ($outputArray as $key => &$i) {
            array_unshift($i, $headers[$key]);
        }

        foreach ($outputArray as &$i) {
            foreach ($i as $j=>$row) {
                if ($row === null)
                    unset($i[$j]);
            }

        }*/

        var_dump($outputArray);

        foreach ($outputArray as $key => $fields) {
            fputcsv($file, $fields);
        }

        fclose($file);
    }
}