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
            TecnicosTableSeeder::class,
            TalleresTableSeeder::class,
            IncidenciasTablaSeeder::class,
            ClientesTableSeeder::class,
            VehiculosTableSeeder::class,
            ComentariosTableSeeder::class,
            OperariosTableSeeder::class,
            CoordinadoresTableSeeder::class,
        ]);
    }
}
