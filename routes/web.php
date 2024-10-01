<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\Auth\AuthController;



Route::prefix('admin')->group(function () {

    // Authentication Routes (No auth middleware for login, registration, and password reset)
    Route::get('login', [AuthController::class,'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class,'login']);
    Route::get('logout', [AuthController::class,'logout'])->name('logout');

    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class,'register']);

    // Password Reset Routes
    Route::get('forgot-password', [AuthController::class, 'showForgetPasswordForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // Protected Routes (Require Authentication)
    Route::middleware(['auth'])->group(function () {

        // Record Controller Routes
        Route::controller(RecordController::class)->group(function() {
            Route::get('dashboard', 'index')->name('dashboard'); // View all records
            Route::get('records/create', 'create'); // Show form to add a new record
            Route::post('records', 'store'); // Store new record
            Route::get('records/{id}/edit', 'edit'); // Edit record
            Route::put('records/{id}', 'update'); // Update record
            Route::delete('records/{id}', 'destroy'); // Delete record
            Route::get('records/show', 'show'); // Show record

            // Export Route for CSV
            Route::get('records/export', 'exportRecordsToCSV')->name('records.export');

            // Specific records
            Route::get('acic', 'acic_records')->name('acicLoad'); // ACIC records
            Route::get('mds', 'mds_records')->name('mdsLoad'); // MDS records

            // Profile Route
            Route::get('profile','profile')->name('profile');
        });

        Route::put('admin/profile/update', [AuthController::class, 'updateProfile'])->name('admin.profile.update');

        // In web.php (routes file)
        Route::post('admin/password/update', [AuthController::class, 'updatePassword'])->name('admin.updatePassword');



    });

});





















