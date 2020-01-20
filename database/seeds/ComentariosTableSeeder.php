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
        $faker = Faker\Factory::create();

        for($i=0;$i<500;$i++) {
            DB::table('comentarios')->insert([
                'texto' => $faker->realText(180),
                'incidencia_id' => $faker->numberBetween($min = 1, $max = 250)
            ]);
        }
    }
}
