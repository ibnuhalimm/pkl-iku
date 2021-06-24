<?php

namespace Database\Seeders;

use App\Imports\CountryImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('app/private/seed') . '/country.csv';

        Excel::import(new CountryImport(), $csvFile);
    }
}
