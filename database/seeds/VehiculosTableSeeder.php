<?php

use Illuminate\Database\Seeder;

class VehiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        for($i=0;$i<2000;$i++) {
            DB::table('vehiculos')->insert([
                'marca' => $faker->vehicleBrand,
                'modelo' => $faker->vehicleModel,
                'matricula' => $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'),
                'aseguradora' => $faker->company,
                'cliente_id' => $faker->numberBetween($min = 1, $max = 250)
            ]);
        }
    }
}
