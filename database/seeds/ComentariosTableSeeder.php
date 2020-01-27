<?php

use Illuminate\Database\Seeder;

class ComentariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        $ids = array();
        $id = 1;
        for ($x = 0; $x < 250; $x++){
            array_push($ids, $id);
            $id = $id + 10;
        }

        for($i=0;$i<500;$i++) {
            DB::table('comentarios')->insert([
                'texto' => $faker->realText(180),
                'incidencia_id' => $faker->randomElement($ids),
                'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
            ]);
        }
    }
}
