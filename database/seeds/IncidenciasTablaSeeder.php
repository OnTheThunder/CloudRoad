<?php

use Illuminate\Database\Seeder;

class IncidenciasTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $ids = array();
        $id = 1;
        for ($x = 0; $x < 250; $x++){
            array_push($ids, $id);
            $id = $id + 10;
        }

        for($i=0;$i<500;$i++){
            DB::table('incidencias')->insert([
                'descripcion' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'longitud' => $faker->longitude(),
                'latitud' => $faker->latitude(),
                'provincia' => $faker->randomElement($array = array ('Alava','Vizcaya','Guipuzcoa','Navarra')),
                'hora_fin' => $faker->time($format = 'H:i:s', $max = 'now'),
                'estado' => $faker->boolean(50),
                'tipo' => $faker->randomElement($array = array('Pinchazo','Otro','Averia','Golpe')),
                'tecnico_id' => $faker->randomElement($ids),
                'cliente_id' => $faker->randomElement($ids),
                'operador_id' => $faker->randomElement($ids),
            ]);
        }
    }
}
