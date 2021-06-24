<?php

namespace Database\Seeders;

use App\Models\Profession;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionTable = (new Profession())->getTable();

        $data = [
            [
                'name' => 'Pegawai Negeri',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'TNI/Polri',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Pegawai Swasta',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Pengusaha',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Tidak Bekerja',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Pensiun',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Lain-lain',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        DB::table($professionTable)->insert($data);
    }
}
