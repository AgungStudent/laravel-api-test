<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'super admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'seller',
                'guard_name' => 'web'
            ],
        ];

        Role::insert($roles);
        Role::query()->update(['created_at' => now(), 'updated_at' => now()]);

        $permissions = [
            'view products',
            'delete product',
            'show product',
            'update product',
            'create product',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $super_admin = Role::whereName('super admin')->firstOrFail();
        $super_admin->givePermissionTo('view products', 'delete product', 'show product');

        $seller = Role::whereName('seller')->firstOrFail();
        $seller->givePermissionTo('view products',
            'delete product',
            'show product',
            'update product',
            'create product');
    }
}
