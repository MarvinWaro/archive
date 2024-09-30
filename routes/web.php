<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;



Route::prefix('admin')->group(function () {
    Route::controller(RecordController::class)->group(function() {
        Route::get('dashboard', 'index')->name('showAll'); // View all records
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

        // Profile

        Route::get('profile','profile')->name('');
    });
});

Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::get('logout', [LoginController::class,'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class,'register']);

Route::get('forgot-password', [AuthController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');



Route::get('/test-email', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('your_email@gmail.com')
                ->subject('Test Email');
    });

    return 'Email sent!';
});




















