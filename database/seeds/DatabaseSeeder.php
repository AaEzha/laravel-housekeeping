<?php

use App\Kamar;
use App\StatusKamar;
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

        StatusKamar::insert([
            ['status_kamar' => 'Terisi'],
            ['status_kamar' => 'Ready'],
            ['status_kamar' => 'Kosong'],
        ]);

        Kamar::insert([
            ['nomor_kamar' => '101', 'status_kamar_id' => 1],
            ['nomor_kamar' => '102', 'status_kamar_id' => 1],
            ['nomor_kamar' => '103', 'status_kamar_id' => 2],
            ['nomor_kamar' => '104', 'status_kamar_id' => 2],
            ['nomor_kamar' => '105', 'status_kamar_id' => 3],
            ['nomor_kamar' => '106', 'status_kamar_id' => 3],
        ]);
    }
}
