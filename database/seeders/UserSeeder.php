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

        //  create permissions for each section
        //  Tickets section
        Permission::create(['name' => 'ticket.take']);
        Permission::create(['name' => 'ticket.edit']);
        Permission::create(['name' => 'ticket.create']);
        Permission::create(['name' => 'ticket.show']);
        Permission::create(['name' => 'ticket.destroy']);
        Permission::create(['name' => 'ticket.commit']);

        //  Users section
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.show']);
        Permission::create(['name' => 'user.destroy']);

        //  create roles and assign created permissions
        //  super user with all permissions
        $sa = Role::create(['name' => 'root']);
        //  gets all permission via Gate::before

        //  admin user
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'ticket.take',
            'ticket.edit',
            'ticket.create',
            'ticket.show',
            'ticket.destroy',
            'ticket.commit',
            'user.edit',
            'user.create',
            'user.show',
            'user.destroy'
        ]);

        //  soporte user
        $soporte = Role::create(['name' => 'soporte']);
        $soporte->givePermissionTo([
            'ticket.take',
            'ticket.create',
            'ticket.show',
            'ticket.commit',
            'user.show'
        ]);

        //  externo
        $externo = Role::create(['name' => 'externo']);
        $externo->givePermissionTo([
            'ticket.edit',
            'ticket.create',
            'ticket.show',
            'user.edit',
            'user.create',
            'user.show'
        ]);

        //  cliente
        $cliente = Role::create(['name' => 'usuario']);
        $cliente->givePermissionTo([
            'ticket.take',
            'ticket.show',
            'ticket.commit'
        ]);


        //  create user's list for development
        $root = User::create([
            'name' => 'root',
            'email' => 'root@root',
            'password' => bcrypt('root'),
            'email_verified_at' => Now()
        ]);
        $root->assignRole($sa);

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
        $user3->assignRole($externo);

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
