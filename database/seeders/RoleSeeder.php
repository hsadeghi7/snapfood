<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole =  Role::create(
            [
                'name' => 'superAdmin',
                'guard_name' => 'web',
            ]
        );
        $adminRole =  Role::create(
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ]
        );
        $sellerRole = Role::create(
            [
                'name' => 'seller',
                'guard_name' => 'web',
            ]
        );
        $buyerRole = Role::create(
            [
                'name' => 'buyer',
                'guard_name' => 'web',
            ]
        );
        //Super Admin Permissions
        $superAdminPermission = Permission::create(['name' => 'fullPermission']);
        $superAdminPermission->assignRole($superAdminRole);
       
       
        //Admin Permissions
        $adminPermission = Permission::create(['name' => 'adminPermission']);
        $adminPermission->assignRole($adminRole);

        //Seller Permissions
        $sellerPermission = Permission::create(['name' => 'sellerPermission']);
        $sellerPermission->assignRole($sellerRole);

        //Buyer Permissions
        $buyerPermission = Permission::create(['name' => 'buyerPermission']);
        $buyerPermission->assignRole($buyerRole);
    }
}
