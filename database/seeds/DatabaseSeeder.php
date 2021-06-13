<?php

use App\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use Modules\Member\Entities\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Tamu'],
            ['name' => 'Petugas']
        ]);

        User::insert([
            ['name' => 'Admin', 'last_name' => 'Pertama', 'email' => 'admin@gmail.com', 'role_id' => '1', 'password' => bcrypt('password')],
            ['name' => 'Tamu', 'last_name' => 'Pertama', 'email' => 'tamu@gmail.com', 'role_id' => '2', 'password' => bcrypt('password')],
            ['name' => 'Menunggu', 'last_name' => '(Pending)', 'email' => 'petugas@gmail.com', 'role_id' => '3', 'password' => bcrypt('password')]
        ]);
    }
}
