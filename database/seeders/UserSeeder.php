<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  create user for development

        User::create([
            'name' => 'Jhon',
            'email' => '1@1',
            'role_id' => '1',
            'password' => bcrypt('1'),
            'email_verified_at' => Now()
        ]);

        User::create([
            'name' => 'Alice',
            'email' => '2@2',
            'role_id' => '2',
            'password' => bcrypt('2'),
            'email_verified_at' => Now()
        ]);
        User::create([
            'name' => 'Jose',
            'email' => '3@3',
            'role_id' => '3',
            'password' => bcrypt('3'),
            'email_verified_at' => Now()
        ]);
        User::create([
            'name' => 'Maria',
            'email' => '4@4',
            'role_id' => '3',
            'password' => bcrypt('4'),
            'email_verified_at' => Now()
        ]);
    }
}
