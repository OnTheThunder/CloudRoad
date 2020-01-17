<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          $this->call(\App\Usuario::class);
        $faker = Faker\Factory::create();

        $usuarioJefe = new \App\Usuario;
        $usuarioJefe->nombre = $faker->name;
        $usuarioJefe->email = 'jefe@jefe.com';
        $usuarioJefe->password = Hash::make('12345678');
        $usuarioJefe->rol = 'jefe';
        $usuarioJefe->save();

        $usuarioCoor = new \App\Usuario;
        $usuarioCoor->nombre = $faker->name;
        $usuarioCoor->email = 'coordinador@coordinador.com';
        $usuarioCoor->password = Hash::make('12345678');
        $usuarioCoor->rol = 'coordinador';
        $usuarioCoor->save();

        $usuarioTecnico = new \App\Usuario;
        $usuarioTecnico->nombre = $faker->name;
        $usuarioTecnico->email = 'tecnico@tecnico.com';
        $usuarioTecnico->password = Hash::make('12345678');
        $usuarioTecnico->rol = 'tecnico';
        $usuarioTecnico->save();

        $usuarioOperador = new \App\Usuario;
        $usuarioOperador->nombre = $faker->name;
        $usuarioOperador->email = 'operario@operario.com';
        $usuarioOperador->password = Hash::make('12345678');
        $usuarioOperador->rol = 'operario';
        $usuarioOperador->save();

    }
}
