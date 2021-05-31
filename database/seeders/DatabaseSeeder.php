<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        RoleSeeder::class,
        ProjectSeeder::class,
        UserSeeder::class,
        PrioritySeeder::class,
        StatusSeeder::class,
        TicketSeeder::class,
        UserTicketSeeder::class
      ]);
      

      /*Role::create(['name' => 'Admin']);
      Role::create(['name' => 'Soporte']);
      Role::create(['name' => 'Cliente']);

      User::truncate();

      $user =new User;
      $user->name = 'John';
      $user->email = '1@1';
      $user->password = bcrypt('1');
      $user->role_id = '1';
      $user->email_verified_at = Now();
      $user->save();

      $user =new User;
      $user->name = 'Alice';
      $user->email = '2@2';
      $user->role_id = '2';
      $user->password = bcrypt('2');
      $user->email_verified_at = Now();
      $user->save();

      $user =new User;
      $user->name = 'Jose';
      $user->email = '3@3';
      $user->role_id = '3';
      $user->password = bcrypt('3');
      $user->email_verified_at = Now();
      $user->save();

      $user =new User;
      $user->name = 'Maria';
      $user->email = '4@4';
      $user->role_id = '3';
      $user->password = bcrypt('4');
      $user->email_verified_at = Now();
      $user->save();*/
/**
    *  rol::truncate();

    *  $rol =new rol;
    *  $rol->name = 'Admin';
    *  $rol->save();

    *  $rol =new rol;
    *  $rol->name = 'Solver';
    *  $rol->save();

    *  $rol =new rol;
    *  $rol->name = 'Standar';
    *  $rol->save(); **/

      // Category::truncate();

      // $category =new Category;
      // $category->name = 'Categoria 1';
      // $category->save();

      // $category =new Category;
      // $category->name = 'Categoria 2';
      // $category->save();

      // $category =new Category;
      // $category->name = 'Categoria 3';
      // $category->save();

      // Priority::truncate();

      // $priority =new Priority;
      // $priority->name = 'Alta';
      // $priority->save();

      // $priority =new Priority;
      // $priority->name = 'Media';
      // $priority->save();

      // $priority =new Priority;
      // $priority->name = 'Baja';
      // $priority->save();

      // Status::truncate();

      // $status =new Status;
      // $status->name = 'Abierto';
      // $status->save();

      // $status =new Status;
      // $status->name = 'Pendiente';
      // $status->save();

      // $status =new Status;
      // $status->name = 'Resuelto ';
      // $status->save();

      // $status =new Status;
      // $status->name = 'Cerrado ';
      // $status->save();

      //  Ticket::truncate();

      // $ticket =new Ticket;
      // $ticket->titulo = 'Soporte';
      // $ticket->user_id = '3';
      // $ticket->status_id = '1';
      // $ticket->priority_id = '1';
      // $ticket->category_id = '2';
      // $ticket->description = 'Problema con...';
      // $ticket->save();

      // $ticket =new Ticket;
      // $ticket->titulo = 'Asesoria';
      // $ticket->user_id = '4';
      // $ticket->status_id = '2';
      // $ticket->priority_id = '2';
      // $ticket->category_id = '3';
      // $ticket->description = 'Problema con...';
      // $ticket->save();

      // $ticket =new Ticket;
      // $ticket->titulo = 'Falla';
      // $ticket->user_id = '1';
      // $ticket->status_id = '3';
      // $ticket->priority_id = '3';
      // $ticket->category_id = '3';
      // $ticket->description = 'Problema con...';
      // $ticket->save();

    }
}
