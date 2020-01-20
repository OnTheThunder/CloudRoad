<?php

use Illuminate\Database\Seeder;

class OperariosTableSeeder extends Seeder
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
            DB::table('operarios')->insert([
                'nombre' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'telefono' => $faker->mobileNumber,
                'dni' => $faker->dni,
                'email' => $faker->email,
                'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
            ]);
        }
    }
}
