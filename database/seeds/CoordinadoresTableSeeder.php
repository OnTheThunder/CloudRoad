<?php

use Illuminate\Database\Seeder;

class CoordinadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        for($i=0;$i<10;$i++){
            DB::table('coordinadores')->insert([
                'nombre' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'telefono' => $faker->mobileNumber,
                'dni' => $faker->regexify('[7][1-9]{7}'),
                'email' => $faker->email,
                'isJefe' => $faker->boolean,
                'usuarios_id' => $faker->numberBetween($min = 1, $max = 100),
                'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
            ]);
        }
    }
}
