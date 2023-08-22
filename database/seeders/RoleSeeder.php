<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allRole=['admin','employer','user'];

        foreach($allRole as $role){
            $newRole = new Role();
            $newRole->name=$role;
            $newRole->save();
        }
    }
}
