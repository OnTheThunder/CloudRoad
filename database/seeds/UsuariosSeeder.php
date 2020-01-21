<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $faker = Faker\Factory::create('es_ES');

        // cuando se creen usuarios, tambien sus clases propias de coord, ope., etc
        // crear 3 coordinadores-JEFES
        for ($i = 0; $i < 3; $i++) {
            $usuarioJefe = new \App\Usuario;
            $usuarioJefe->nombre = $faker->firstName;
            $usuarioJefe->email = 'jefe' . $i . '@jefe' . $i . '.com';
            $usuarioJefe->password = Hash::make('12345678');
            $usuarioJefe->rol = 'jefe';
            $usuarioJefe->save();

            $usuario = DB::table('usuarios')
                ->select('*')
                ->orderByDesc('id')
                ->limit(1)
                ->get();

            foreach ($usuario as $user => $value) {
                DB::table('coordinadores')->insert([
                    'nombre' => $value->nombre,//$faker->firstName,
                    'apellidos' => $faker->lastName,
                    'telefono' => $faker->mobileNumber,
                    'dni' => $faker->regexify('[7][1-9]{7}'),
                    'email' => $value->email,//$faker->email,
                    'isJefe' => true,
                    'usuarios_id' => $value->id,//$faker->numberBetween($min = 1, $max = 100),
                    'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                ]);
            }
        }

        // crear 10 coordinadores
        for ($i = 0; $i < 10; $i++) {
            $usuarioCoor = new \App\Usuario;
            $usuarioCoor->nombre = $faker->name;
            $usuarioCoor->email = 'coordinador' . $i . '@coordinador' . $i . '.com';
            $usuarioCoor->password = Hash::make('12345678');
            $usuarioCoor->rol = 'coordinador';
            $usuarioCoor->save();

            $usuario = DB::table('usuarios')
                ->select('*')
                ->orderByDesc('id')
                ->limit(1)
                ->get();

            foreach ($usuario as $user => $value) {
                DB::table('coordinadores')->insert([
                    'nombre' => $value->nombre,//$faker->firstName,
                    'apellidos' => $faker->lastName,
                    'telefono' => $faker->mobileNumber,
                    'dni' => $faker->regexify('[7][1-9]{7}'),
                    'email' => $value->email,//$faker->email,
                    'isJefe' => false,
                    'usuarios_id' => $value->id,
                    'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                ]);
            }
        }

        // crear 250 tecnicos
        for ($i = 0; $i < 250; $i++) {
            $usuarioTecnico = new \App\Usuario;
            $usuarioTecnico->nombre = $faker->name;
            $usuarioTecnico->email = 'tecnico' . $i . '@tecnico' . $i . '.com';
            $usuarioTecnico->password = Hash::make('12345678');
            $usuarioTecnico->rol = 'tecnico';
            $usuarioTecnico->save();

            $usuario = DB::table('usuarios')
                ->select('*')
                ->orderByDesc('id')
                ->limit(1)
                ->get();

            foreach ($usuario as $user => $value) {
                DB::table('tecnicos')->insert([
                    'turno' => $faker->randomElement(['manana', 'tarde', 'noche']),
                    'disponibilidad' => $faker->boolean,
                    'nombre' => $value->nombre,
                    'apellidos' => $faker->lastName,
                    'telefono' => $faker->mobileNumber,
                    'dni' => $faker->regexify('[7][1-9]{7}'),
                    'email' => $value->email,
                    'usuarios_id' => $value->id,
                    'taller_id' => $faker->numberBetween($min = 1, $max = 8),
                    'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                ]);
            }
        }


        // crear 10 operarios
        for ($i = 0; $i < 10; $i++) {
            $usuarioOperador = new \App\Usuario;
            $usuarioOperador->nombre = $faker->name;
            $usuarioOperador->email = 'operario' . $i . '@operario' . $i . '.com';
            $usuarioOperador->password = Hash::make('12345678');
            $usuarioOperador->rol = 'operario';
            $usuarioOperador->save();

            $usuario = DB::table('usuarios')
                ->select('*')
                ->orderByDesc('id')
                ->limit(1)
                ->get();

            foreach ($usuario as $user => $value) {
                DB::table('operarios')->insert([
                    'nombre' => $value->nombre,
                    'apellidos' => $faker->lastName,
                    'telefono' => $faker->mobileNumber,
                    'dni' => $faker->dni,
                    'email' => $value->email,
                    'usuarios_id' => $value->id,
                    'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                ]);
            }
        }
    }
}
