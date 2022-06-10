<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = "system_admin";
        $role_admin->description = "system_admin";
        $role_admin->save();
 
        $role_cus = new Role();
        $role_cus->name = "customer";
        $role_cus->description = "A Customer";
        $role_cus->save();

        $role_user = new RoleUser();
        $role_user->user_id = '1';
        $role_user->role_id = '1';
        $role_user->save();
    }
}
