<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TalleresTableSeeder::class,
            IncidenciasTablaSeeder::class,
            UsuariosSeeder::class,
            ClientesTableSeeder::class,
            VehiculosTableSeeder::class,
            ComentariosTableSeeder::class
        ]);
    }
}
