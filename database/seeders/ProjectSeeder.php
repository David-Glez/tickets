<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Projects;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Projects::create([
            'empresa' => 'Notaria publica 21',
            'rfc' => 'AAA000000AB1'
        ]);

        Projects::create([
            'empresa' => 'Notaria publica 36',
            'rfc' => 'BBB000000AB2'
        ]);
    }
}
