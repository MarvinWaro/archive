<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;

Route::prefix('admin')->group(function () {
    Route::controller(RecordController::class)->group(function() {
        Route::get('dashboard', 'index'); // View all records
        Route::get('records/create', 'create'); // Show form to add a new record
        Route::post('records', 'store'); // Store new record
        Route::get('records/{id}/edit', 'edit'); // Edit record
        Route::put('records/{id}', 'update'); // Update record
        Route::delete('records/{id}', 'destroy'); // Delete record
        Route::get('records/show', 'show');

        // Export Route for CSV
        Route::get('records/export', 'exportRecordsToCSV')->name('records.export');

        Route::get('acic', 'acic_records')->name('acicLoad'); // ACIC records
        Route::get('mds', 'mds_records'); // MDS records
    });
});
















