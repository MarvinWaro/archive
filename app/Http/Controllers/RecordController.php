<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\SubmissionYear;
use App\Models\Record;
use League\Csv\Writer; // Correct Writer import
use \SplTempFileObject; // Correct

class RecordController extends Controller
{
    public function index() {
        // Get the records with eager loading of year and submission year
        $records = Record::with(['year', 'submissionYear'])->get();
        // Count ACIC folders
        $acicCount = Record::where('folder_name', 'LIKE', 'ACIC%')->count();
        // Count MDS folders
        $mdsCount = Record::where('folder_name', 'LIKE', 'MDS%')->count();
        // Count completed folders
        $completedCount = Record::where('status', 'completed')->count();
        // Count in-progress folders
        $inProgressCount = Record::where('status', 'in_progress')->count();
        // Pass the records and counts to the view
        return view("admin.dashboard", compact('records', 'acicCount', 'mdsCount', 'completedCount', 'inProgressCount'));
    }



    public function exportRecordsToCSV()
    {
        $records = Record::with(['year', 'submissionYear'])->get();

        // Create a CSV Writer instance using a temporary file
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        // Add the headers (all in uppercase)
        $csv->insertOne([
            'ID', 'YEAR', 'MONTH', 'FOLDER NAME', 'FOLDER TYPE',
            'NUMBER', 'SUBMISSION YEAR', 'SUBMISSION MONTH', 'STATUS', 'OTHERS', 'REMARKS'
        ]);

        // Add the data
        foreach ($records as $record) {
            // Convert month number to month name
            $monthName = date('F', mktime(0, 0, 0, $record->month, 10)); // Convert month number to full month name
            $submissionMonthName = date('F', mktime(0, 0, 0, $record->submission_month, 10));

            // Folder name transformations
            $folderName = strtoupper(str_replace('_', ' ', $record->folder_name));

            // Custom handling for specific folder names like ACIC_151 to ACIC 151
            $folderNameReplacements = [
                'ACIC_151' => 'ACIC 151',
                'ACIC_101' => 'ACIC 101',
                'ACIC_COSCO' => 'ACIC COSCO',
                'MDS_151'   => 'MDS 151',
                'MDS_101'   => 'MDS 101'
            ];

            if (array_key_exists($record->folder_name, $folderNameReplacements)) {
                $folderName = $folderNameReplacements[$record->folder_name];
            }

            // Ensure all other fields are in uppercase
            $csv->insertOne([
                $record->id,
                strtoupper($record->year->year),
                strtoupper($monthName),
                $folderName,
                strtoupper($record->folder_type),
                strtoupper($record->number),
                strtoupper($record->submissionYear->year),
                strtoupper($submissionMonthName),
                strtoupper($record->status),
                strtoupper($record->others),
                strtoupper($record->remarks)
            ]);
        }

        // Output the CSV file for download
        return response((string) $csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="records.csv"');
    }



    public function create() {
        $years = Year::orderBy('year', 'desc')->get(); // Fetch years in descending order
        $submission_years = SubmissionYear::orderBy('year', 'desc')->get(); // Fetch submission years in descending order
        return view('admin.create', compact('years', 'submission_years'));
    }


    public function store(Request $request) {
        $request->validate([
            'year_id' => 'required',
            'month' => 'required',
            'folder_name' => 'required',
            'folder_type' => 'required',
            'number' => 'required',
            'submission_year_id' => 'required',
            'submission_month' => 'required',
            'status' => 'required',
            'others' => 'required',
        ]);

        $record = new Record;
        $record->year_id = $request->year_id;
        $record->month = $request->month;
        $record->folder_name = $request->folder_name;
        $record->folder_type = $request->folder_type;
        $record->number = $request->number;
        $record->submission_year_id = $request->submission_year_id;
        $record->submission_month = $request->submission_month;
        $record->status = $request->status;
        $record->others = $request->others;
        $record->remarks = $request->remarks;

        $record->save();

        return redirect('admin/dashboard')->with('message', 'Record Created Successfully');
    }

    public function edit(int $id) {
        $years = Year::orderBy('year', 'desc')->get(); // Fetch years in descending order
        $submission_years = SubmissionYear::orderBy('year', 'desc')->get(); // Fetch submission years in descending order

        $record = Record::findOrFail($id); // Change this line to use $record

        return view('admin.edit', compact('record', 'years', 'submission_years')); // Use 'record' here
    }


    public function update(Request $request, $id) {
        $request->validate([
            'year_id' => 'required',
            'month' => 'required',
            'folder_name' => 'required',
            'folder_type' => 'required',
            'number' => 'required',
            'submission_year_id' => 'required',
            'submission_month' => 'required',
            'status' => 'required',
            'others' => 'required',
        ]);

        $record = Record::findOrFail($id);
        $record->year_id = $request->year_id;
        $record->month = $request->month;
        $record->folder_name = $request->folder_name;
        $record->folder_type = $request->folder_type;
        $record->number = $request->number;
        $record->submission_year_id = $request->submission_year_id;
        $record->submission_month = $request->submission_month;
        $record->status = $request->status;
        $record->others = $request->others;
        $record->remarks = $request->remarks;

        $record->save();

        return redirect('admin/dashboard')->with('message', 'Record Updated Successfully');
    }

    public function destroy($id)
    {
        $record = Record::findOrFail($id);
        $record->delete();

        return redirect('admin/dashboard')->with('deleted', 'Record deleted successfully.');
    }

    public function show($id)
    {
        $record = Record::with(['year', 'submissionYear'])->findOrFail($id);
        return response()->json($record); // You can return this via AJAX if needed
    }


// ACIC


    public function acic_records() {
        // Assuming 'folder_name' is the column where 'ACIC' folders are stored
        $acic_records = Record::with(['year', 'submissionYear'])
                         ->where('folder_name', 'LIKE', 'ACIC%') // Filter for records with folder_name starting with 'ACIC'
                         ->get(); // Eager load year and submission year relationships

        return view("admin.acic.acic", compact('acic_records'));
    }

    public function mds_records() {
        // Assuming 'folder_name' is the column where 'ACIC' folders are stored
        $mds_records = Record::with(['year', 'submissionYear'])
                         ->where('folder_name', 'LIKE', 'MDS%') // Filter for records with folder_name starting with 'ACIC'
                         ->get(); // Eager load year and submission year relationships

        return view("admin.mds.mds", compact('mds_records'));
    }


    // Profile

    Public function profile(){
        return view('admin.profile');
    }


}
