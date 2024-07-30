<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define the permissions and roles
        $permissions = ['manage user'];
        $roles = [
            'admin' => ['permissions' => ['manage user']],
            'user' => ['permissions' => []] // Ensure 'permissions' key exists for all roles
        ];

        // Create or update permissions
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Create or update roles and assign permissions
        foreach ($roles as $roleName => $roleData) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            if (isset($roleData['permissions'])) {
                foreach ($roleData['permissions'] as $permissionName) {
                    $permission = Permission::where('name', $permissionName)->first();
                    if ($permission && !$role->hasPermissionTo($permission)) {
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }

        // Assign roles to users
        $users = User::all(); // Retrieve all users. Adjust this if you only want to assign roles to specific users

        foreach ($users as $user) {
            // Example: Assign 'admin' role to the first user and 'user' role to others
            if ($user->id === 1) {
                if (!$user->hasRole('admin')) {
                    $user->assignRole('admin');
                }
            } else {
                if (!$user->hasRole('user')) {
                    $user->assignRole('user');
                }
            }
        }
    }
}
