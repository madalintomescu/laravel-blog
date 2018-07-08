<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Permissions
        Permission::create(['name' => 'manage posts']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage permissions']);

        // Roles
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo(['manage posts', 'manage users']);

        $role = Role::create(['name' => 'author']);
        $role->givePermissionTo(['manage posts']);

        $role = Role::create(['name' => 'user']);

		// Users
        $admin = App\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        $admin_role = Role::findByName('admin');
        $admin->assignRole($admin_role);

        $moderator = App\User::create([
            'name' => 'Moderator',
            'email' => 'moderator@example.com',
            'password' => bcrypt('password')
        ]);
        $moderator_role = Role::findByName('moderator');
        $moderator->assignRole($moderator_role);

        $author = App\User::create([
            'name' => 'Author',
            'email' => 'author@example.com',
            'password' => bcrypt('password')
        ]);
        $author_role = Role::findByName('author');
        $author->assignRole($author_role);

        $user = App\User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ]);
        $user_role = Role::findByName('user');
        $user->assignRole($user_role);

        // Categories
        $uncategorized = App\Category::create([
            'name' => 'Uncategorized',
            'description' => 'Default category'
        ]);

    	// Tags
        $tag = App\Tag::create([
            'name' => 'News',
            'description' => 'A simple tag'
        ]);

    }
}
