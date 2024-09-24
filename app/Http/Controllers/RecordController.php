<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\SubmissionYear;
use App\Models\Record;

class RecordController extends Controller
{
    public function index() {
        // Get the records with eager loading of year and submission year
        $records = Record::with(['year', 'submissionYear'])->get();

        $acicCount = Record::where('folder_name', 'LIKE', 'ACIC%')->count();
        // Get the count of MDS folders based on folder_name
        $mdsCount = Record::where('folder_name', 'LIKE', 'MDS%')->count();
        // Pass the records and counts to the view

        return view("admin.dashboard", compact('records', 'acicCount', 'mdsCount'));
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

}
