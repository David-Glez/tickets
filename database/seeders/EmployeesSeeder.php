<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Employees;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Employees::create([
            'user_id' => 1,
            'names' => 'Super',
            'last_name' => 'Admin',
            'department' => 1
        ]);

        Employees::create([
            'user_id' => 2,
            'names' => 'John',
            'last_name' => 'Smith',
            'department' => 2
        ]);

        Employees::create([
            'user_id' => 3,
            'names' => 'Alice',
            'last_name' => 'Evans',
            'department' => 2
        ]);

        Employees::create([
            'user_id' => 4,
            'names' => 'Jose',
            'last_name' => 'Alvarez',
            'department' => 3
        ]);

        Employees::create([
            'user_id' => 5,
            'names' => 'Maria',
            'last_name' => 'Dorame',
            'department' => 3
        ]);
    }
}
