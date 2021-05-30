<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  create a tickets list for development
        Ticket::create([
            'titulo' => 'Soporte',
            'status_id' => '1',
            'priority_id' => '1',
            'category_id' => '2',
            'description' => 'Problema con...'
        ]);

        Ticket::create([
            'titulo' => 'Asesoria',
            'status_id' => '2',
            'priority_id' => '2',
            'category_id' => '3',
            'description' => 'Problema con...'
        ]);

        Ticket::create([
            'titulo' => 'Falla',
            'status_id' => '3',
            'priority_id' => '3',
            'category_id' => '3',
            'description' => 'Problema con...'
        ]);
    }
}
