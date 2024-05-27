<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@apotek-lamganda.com',
            'password' => Hash::make('123456'),
            'role'  => 'admin',
            'phone' => '085677778910'
        ]);

        \App\Models\User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@apotek-lamganda.com',
            'password' => Hash::make('123456'),
            'role'  => 'karyawan',
            'phone' => '085622278910'
        ]);

        \App\Models\User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('123456'),
            'role'  => 'customer',
            'phone' => '085611178910'
        ]);
    }
}
