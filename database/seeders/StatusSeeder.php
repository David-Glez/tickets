<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  create ticket status
        Status::create([
            'name' => 'Abierto'
        ]);

        Status::create([
            'name' => 'Pendiente'
        ]);

        Status::create([
            'name' => 'Resuelto'
        ]);

        Status::create([
            'name' => 'Cerrado'
        ]);
    }
}
