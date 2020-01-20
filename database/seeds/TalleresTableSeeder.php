<?php

use Illuminate\Database\Seeder;

class TalleresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayTalleres = [
            0 => [
                'nombre' => 'Talleres SpeedUp',
                'latitud' => '42.842326386012516',
                'longitud' => '-2.691612846296414',
                'provincia' => 'Araba'
            ],
            1 => [
                'nombre' => 'Tecnicos go',
                'latitud' => '42.871272882682675',
                'longitud' => '-2.3072412848712087',
                'provincia' => 'Araba'
            ],
            2 => [
                'nombre' => 'Help Road',
                'latitud' => '43.24478743516591',
                'longitud' => '-2.927818900983914',
                'provincia' => 'Bizkaia'
            ],
            3 => [
                'nombre' => 'Natura Asistencia',
                'latitud' => '43.04027999188252',
                'longitud' => '-2.654533988874539',
                'provincia' => 'Bizkaia'
            ],
            4 => [
                'nombre' => 'Simple Help',
                'latitud' => '43.3019993718923',
                'longitud' => '-1.969261772077664',
                'provincia' => 'Gipuzkoa'
            ],
            5 => [
                'nombre' => 'Errepide Berria',
                'latitud' => '43.176588594823166',
                'longitud' => '-2.261273197638276',
                'provincia' => 'Gipuzkoa'
            ],
            6 => [
                'nombre' => 'RoadTech Securitas',
                'latitud' => '42.80482922995861',
                'longitud' => '-1.6530319775390545',
                'provincia' => 'Nafarroa'
            ],
            7 => [
                'nombre' => 'Safe Assistance',
                'latitud' => '42.66329141977841',
                'longitud' => '-2.0343143442186706',
                'provincia' => 'Nafarroa'
            ],
        ];

        for($i=0;$i<count($arrayTalleres);$i++){
            DB::table('tallers')->insert([
                $arrayTalleres[$i]
            ]);
        }


    }
}
