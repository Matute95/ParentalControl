<?php

namespace Database\Seeders;

use App\Models\Llamada\Llamada;
use Illuminate\Database\Seeder;

class LlamadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $llamadas = [
            [
                'aceptada' =>true,
                'fecha' =>  '2015-11-01 14:10:00',
                'tiempo' => '00:00:45',
                'contacto_id' => 1,
            ],
            [
                'aceptada' =>false,
                'fecha' =>  '2015-11-02 19:30:00',
                'tiempo' => '00:00:00',
                'contacto_id' => 2,
            ],
            [
                'aceptada' =>true,
                'fecha' =>  '2015-12-20 11:08:21',
                'tiempo' => '00:02:45',
                'contacto_id' => 3,
            ],
            [
                'aceptada' =>false,
                'fecha' =>  '2015-12-18 13:12:00',
                'tiempo' => '00:01:45',
                'contacto_id' => 6,
            ],
            [
                'aceptada' =>false,
                'fecha' =>  '2015-12-22 08:10:00',
                'tiempo' => '00:00:00',
                'contacto_id' => 7,
            ],
            [
                'aceptada' =>true,
                'fecha' =>  '2015-11-03 14:10:00',
                'tiempo' => '00:00:45',
                'contacto_id' => 8,
            ],
            [
                'aceptada' =>false,
                'fecha' =>  '2015-11-05 19:30:00',
                'tiempo' => '00:00:00',
                'contacto_id' => 4,
            ],
            [
                'aceptada' =>true,
                'fecha' =>  '2015-12-11 11:08:21',
                'tiempo' => '00:02:45',
                'contacto_id' => 5,
            ],
            [
                'aceptada' =>false,
                'fecha' =>  '2015-12-12 13:12:00',
                'tiempo' => '00:01:45',
                'contacto_id' => 9,
            ],
            [
                'aceptada' =>false,
                'fecha' =>  '2015-12-25 08:10:00',
                'tiempo' => '00:00:00',
                'contacto_id' => 10,
            ],
            [
                'aceptada' =>true,
                'fecha' =>  '2015-12-07 11:08:21',
                'tiempo' => '00:02:45',
                'contacto_id' => 11,
            ],
            [
                'aceptada' =>false,
                'fecha' =>  '2015-12-18 13:12:00',
                'tiempo' => '00:01:45',
                'contacto_id' => 12,
            ],
           
        ];
        foreach ($llamadas as $llamada) {
            Llamada::create($llamada);
        }
    }
}
