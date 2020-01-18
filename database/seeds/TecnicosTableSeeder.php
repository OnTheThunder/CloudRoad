<?php

use Illuminate\Database\Seeder;

class TecnicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0;$i<250;$i++){
            DB::table('tecnicos')->insert([
                'turno' => $faker->randomElement(['manana', 'tarde', 'noche']),
                'disponibilidad' => $faker->boolean,
                'nombre' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'telefono' => $faker->phoneNumber,
                'dni' => $faker->regexify('[7][1-9]{7}'),
                'email' => $faker->email,
                'taller_id' => $faker->numberBetween($min = 1, $max = 8)
            ]);
        }


    }
}
