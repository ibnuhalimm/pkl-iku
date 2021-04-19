<?php

namespace Database\Seeders;

use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new User())->getTable())->truncate();

        User::create([
            'name' => 'Super User',
            'username' => 'superuser',
            'email' => 'superuser@gmail.com',
            'email_verified_at' => new DateTime(),
            'password' => bcrypt(1234),
            'role_id' => 1
        ]);
    }
}
