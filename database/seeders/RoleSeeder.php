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
        Role::insert([
            [
                'id' => 1,
                'code' => 'super-admin',
                'name' => 'Super Admin',
        
            ],
            [
                'id' => 2,
                'code' => 'head-office-admin',
                'name' => 'Admin Kantor Pusat',        
            ],
            [
                'id' => 3,
                'code' => 'supervisor',
                'name' => 'Supervisor',        
            ],
            [
                'id' => 4,
                'code' => 'branch-manager',
                'name' => 'Manager Cabang',        
            ],
            [
                'id' => 5,
                'code' => 'branch-office-admin',
                'name' => 'Admin Kantor Cabang',        
            ],
            [
                'id' => 6,
                'code' => 'credit-manager',
                'name' => 'Manager Kredit',        
            ],
            [
                'id' => 7,
                'code' => 'credit-collection',
                'name' => 'Collection/Analys Credit',        
            ],
        ]);
    }
}
