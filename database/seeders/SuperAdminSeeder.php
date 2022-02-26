<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addRolesAndPermissions();
    }

    private function addRolesAndPermissions()
    {
        // create permissions for an admin
        $adminPermissions = collect(['products-full', 'caetgory-full', 'warehouse-full','sales-full','invoices-full','clients-full','purchase-full','bills-full','suppliers-full','role-full','user-full'])->map(function ($name) {
            return Permission::create(['name' => $name,'slug'=>$name]);
        });
        // add admin role
        $adminRole = Role::create(['name' => 'SuperAdmin','slug'=>'superadmin']);

        foreach ($adminPermissions as $permission) {
            $adminRole->permissions()->attach($permissions->id);
        }   
    }
}
