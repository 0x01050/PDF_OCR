<?php
use Illuminate\Support\Facades\File;

if (! function_exists('writeToPDF')) {
    function writeToPDF($fields) {
        $pdf_file = time() . random_string();
        $pdf_file = $pdf_file . '.pdf';
        File::copy(resource_path() . '/binary/1003_template.pdf', storage_path('app/' . $pdf_file));

        return $pdf_file;
    }
}

?>
