<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\actions;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        actions::create([
            'name' => 'Añadir'
        ]);
        actions::create([
            'name' => 'Editar'
        ]);
        actions::create([
            'name' => 'Eliminar'
        ]);
        actions::create([
            'name' => 'Tomar'
        ]);
        actions::create([
            'name' => 'Comentar'
        ]);
        actions::create([
            'name' => 'Status'
        ]);
        actions::create([
            'name' => 'Rechazar'
        ]);
        actions::create([
            'name' => 'Desactivar'
        ]);
    }
}
