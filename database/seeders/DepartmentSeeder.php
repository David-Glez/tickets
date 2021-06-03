<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Departments;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Departments::create([
            'name' => 'Gerencia'
        ]);

        Departments::create([
            'name' => 'Sistemas'
        ]);

        Departments::create([
            'name' => 'Externo'
        ]);
    }
}
