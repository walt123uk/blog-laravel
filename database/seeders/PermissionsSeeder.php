<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'delete comments']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'viewer']);
        $role1->givePermissionTo('view posts');
        $role1->givePermissionTo('create comments');

        $role2 = Role::create(['name' => 'author']);
        $role2->givePermissionTo('view posts');
        $role2->givePermissionTo('create posts');
        $role2->givePermissionTo('edit posts');
        $role2->givePermissionTo('delete posts');

        $role3 = Role::create(['name' => 'admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\User::factory()->create([
            'name' => 'Example Viewer',
            'email' => 'viewer@example.com',
            'password' => 'password',
        ]);
        $user->assignRole($role1);

        $user = \App\User::factory()->create([
            'name' => 'Example Author',
            'email' => 'author@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\User::factory()->create([
            'name' => 'Example Admin',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role3);
    }
}
