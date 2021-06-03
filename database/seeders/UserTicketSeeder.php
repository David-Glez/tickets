<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User_Ticket;

class UserTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  create user - ticket relationship
        User_Ticket::create([
            'user_id' => 2,
            'ticket_id' => 3
        ]);

        User_Ticket::create([
            'user_id' => 4,
            'ticket_id' => 1
        ]);

        User_Ticket::create([
            'user_id' => 5,
            'ticket_id' => 2
        ]);
    }
}
