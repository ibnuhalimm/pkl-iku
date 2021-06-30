<?php

namespace Database\Seeders;

use App\Models\CompanyCategory;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyCategoryTable = (new CompanyCategory())->getTable();

        $data = [
            [
                'name' => 'Swasta',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Nirlaba',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Multinasional',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Lembaga Pemerintah',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'BUMN',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'BUMD',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        DB::table($companyCategoryTable)->insert($data);
    }
}
