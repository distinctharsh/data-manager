<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientDataController extends Controller
{
    public function export(Request $request)
    {
        $headings = ['Email', 'First_Name', 'Last_Name', 'Company Name',  'City', 'Job Position', 'Industry', 'Company Size', 'Country', 'Linked In Url', 'Website', 'Phone'];

        try {
            $importedDataArray = Excel::toArray([], $request->file('file'), null);
            if (!$this->validateExcelFile($importedDataArray[0][0])) {
                return response()->json(['error' => true, 'message' => "File headings does not match"], 422);
            }
            $filteredData = [];
            $emailsProcessed = [];
            foreach ($importedDataArray[0] as $index => $row) {
                if ($index == 0) {
                    continue;
                }
                $trimmedRow = trim($row[0]);
                $valid =  $trimmedRow != '' && $trimmedRow != null;
                $wordsToCheck = array('.org', '.edu', '.gov', '.ru', '.cn', 'cyber', 'recruit', 'google', 'facebook', 'www.');

                foreach ($wordsToCheck as $word) {
                    if (stripos($trimmedRow, $word) !== false) {
                        $valid = false;
                    }
                }
                if ($valid && !in_array($trimmedRow, $emailsProcessed)) {
                    $existInDB  = ClientData::where(['email' => $trimmedRow, 'client_id' => $request->client_id])->exists();
                    if (!$existInDB) {
                        array_push($emailsProcessed, $trimmedRow);
                        $row[1] =  ClientDataImport::removeNonEnglishLetters($row[1]);
                        $row[2] = ClientDataImport::removeNonEnglishLetters($row[2]);
                        $tempCompanyName = explode(" ", ClientDataImport::removeNonEnglishLetters($row[3]));
                        $row[3] = implode(" ", array_splice($tempCompanyName, 0, 2));
                        $row[4] = ucfirst(strtolower(trim($row[4])));
                        $row[8] =  ucfirst(strtolower(trim($row[8])));
                        $trimmedLinkedInURL = trim($row[9]);
                        if ($trimmedLinkedInURL != null && $trimmedLinkedInURL != '') {
                            $row[9] = preg_replace('/\/sales\/people\/(.*?),.*?\)/', '/in/$1', $trimmedLinkedInURL);
                        }
                        array_push($filteredData, $row);
                    }
                }
            }
            return Excel::download(new ClientDataExport($headings, $filteredData), 'output.xlsx');
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()]);
        }
    }
}
