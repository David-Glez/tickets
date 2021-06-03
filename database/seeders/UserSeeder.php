<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //  roles and permissions using laravel-permission
        
        //  reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //  create permissions
        Permission::create(['name' => 'index']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'show']);
        Permission::create(['name' => 'destroy']);

        //  create roles and assign created permissions
        //  super user with all permissions
        $role = Role::create(['name' => 'root']);
        //  gets all permission via Gate::before

        //  admin user
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'index',
            'create',
            'edit',
            'show',
            'destroy'
        ]);

        //  soporte user
        $soporte = Role::create(['name' => 'soporte']);
        $soporte->givePermissionTo([
            'index',
            'show',
            'edit'
        ]);

        //  cliente
        $cliente = Role::create(['name' => 'cliente']);
        $cliente->givePermissionTo([
            'index',
            'show'
        ]);

        //  create user's list for development
        $root = User::create([
            'name' => 'root',
            'email' => 'root@root',
            'password' => bcrypt('root'),
            'email_verified_at' => Now()
        ]);

        $user1 = User::create([
            'name' => 'Jhon',
            'email' => '1@1',
            //'role_id' => '1',
            'password' => bcrypt('1'),
            'email_verified_at' => Now()
        ]);
        $user1->assignRole($admin);

        $user2 = User::create([
            'name' => 'Alice',
            'email' => '2@2',
            //'role_id' => '2',
            'password' => bcrypt('2'),
            'email_verified_at' => Now()
        ]);
        $user2->assignRole($soporte);


        $user3 = User::create([
            'name' => 'Jose',
            'email' => '3@3',
            //'role_id' => '3',
            'password' => bcrypt('3'),
            'email_verified_at' => Now()
        ]);
        $user3->assignRole($cliente);

        $user4 = User::create([
            'name' => 'Maria',
            'email' => '4@4',
            //'role_id' => '3',
            'password' => bcrypt('4'),
            'email_verified_at' => Now()
        ]);
        $user4->assignRole($cliente);
    }
}
