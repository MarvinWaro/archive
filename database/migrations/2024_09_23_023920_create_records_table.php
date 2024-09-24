<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('year_id')->constrained('years')->onDelete('cascade'); // FK from years
            $table->string('month'); // Month as a string or int (e.g., 'January', '02')
            $table->string('folder_name'); // Folder name
            $table->string('folder_type'); // Folder type
            $table->longText('number'); // Alpha-numeric number
            $table->foreignId('submission_year_id')->constrained('submission_years')->onDelete('cascade'); // FK from submission_years
            $table->string('submission_month'); // Submission month
            $table->string('status'); // Status (e.g., In-Progress, Completed)
            $table->string('others'); // Others field
            $table->text('remarks')->nullable(); // Remarks field
            $table->timestamps(); // Created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
