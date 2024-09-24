<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;

// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// });

// Route::get('admin/acic', function () {
//     return view('admin.acic.acic');
// });

// Route::get('admin/mds', function () {
//     return view('admin.mds.mds');
// });

// // Route::get('admin/acic/add', function () {
// //     return view('admin.acic.add');
// // });

// Route::get('admin/mds/add', function () {
//     return view('admin.mds.add');
// });

// Route::get('admin/acic/edit', function () {
//     return view('admin.acic.edit');
// });

// Route::get('admin/mds/edit', function () {
//     return view('admin.mds.edit');
// });

// Route::get('admin/login', function () {
//     return view('auth.login');
// });



Route::prefix('admin')->group(function () {
    Route::controller(RecordController::class)->group(function() {
        Route::get('dashboard', 'index'); // View all records
        Route::get('records/create', 'create'); // Show form to add a new record
        Route::post('records', 'store'); // Store new record

        Route::get('acic','acic_records')->name('acicLoad');
        Route::get('mds','mds_records');
    });
});















