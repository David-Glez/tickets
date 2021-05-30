<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  create priority's level
        Priority::create([
            'name' => 'Alta'
        ]);
        Priority::create([
            'name' => 'Media'
        ]);
        Priority::create([
            'name' => 'Baja'
        ]);
    }
}
