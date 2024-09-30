<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Year;

class YearsTableSeeder extends Seeder
{
    public function run()
    {
        $currentYear = date('Y');
        for ($year = 2015; $year <= $currentYear; $year++) {
            Year::updateOrCreate(['year' => $year]); // Insert if the year doesn't exist
        }
    }
}
