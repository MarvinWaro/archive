<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubmissionYear;

class SubmissionYearsTableSeeder extends Seeder
{
    public function run()
    {
        $currentYear = date('Y'); // Get the current year
        for ($year = 2015; $year <= $currentYear; $year++) {
            SubmissionYear::updateOrCreate(['year' => $year]); // Insert if the year doesn't exist
        }
    }
}
