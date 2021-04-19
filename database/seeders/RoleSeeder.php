<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Role())->getTable())->truncate();

        DB::table((new Role())->getTable())->insert([
            [ 'name' => 'Super User' ],
            [ 'name' => 'Admin' ]
        ]);
    }
}
