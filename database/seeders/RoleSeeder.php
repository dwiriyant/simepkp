<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::createMany([
            [
                'code' => 'superadmin',
                'name' => 'Super Admin',
        
            ],
            [
                'code' => 'manager',
                'name' => 'Manager',        
            ],
        ]);
    }
}
