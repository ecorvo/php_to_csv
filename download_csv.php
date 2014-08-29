<?php

function convert_to_csv($input_array, $output_file_name, $delimiter)
{
    /** open raw memory as file, no need for temp files, be careful not to run out of memory thought */
    $f = fopen('php://memory', 'w');
    /** loop through array  */
    foreach ($input_array as $line) {
        /** default php csv handler **/
        fputcsv($f, $line, $delimiter);
    }
    /** rewrind the "file" with the csv lines **/
    fseek($f, 0);
    /** modify header to be downloadable csv file **/
    header('Content-Type: application/csv');
    header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
    /** Send file to browser for download */
    fpassthru($f);
}

/** Array to convert to csv */

$array_to_csv = Array(
    Array(12566,
        'Enmanuel',
        'Corvo'
    ),
    Array(56544,
        'John',
        'Doe'
    ),
    Array(78550,
        'Mark',
        'Smith'
    )

);

convert_to_csv($array_to_csv, 'report.csv', ',');