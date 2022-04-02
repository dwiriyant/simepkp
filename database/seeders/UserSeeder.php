<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Admin Kantor Pusat',
            'email' => 'admin@sulutgo.co.id',
            'role_id' => '1',
            'password' => Hash::make('admin123'),
        ]);
    }
}
