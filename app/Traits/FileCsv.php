<?php

namespace App\Traits;
trait FileCsv {
    // public function importCSV($file)
    // {
    //     $filePath = $file->getRealPath();
    //     $data = array();
    //     $fileHandle = fopen($filePath, 'r');
    //     while (($rowData = fgetcsv($fileHandle, 1000, ",")) !== FALSE) {
    //         User::create([
    //             'name' => $rowData[0],
    //             'email' => $rowData[1],
    //             'password' => Hash::make($rowData[2])
    //         ]);
    //     }
    
    //     return $data;
    // }

    function readCsv($filepath){
		$file = fopen($filepath,"r");
		$data = fgetcsv($file);
		fclose($file);
		return $data;
	}
}