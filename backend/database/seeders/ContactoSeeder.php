<?php

namespace Database\Seeders;

use App\Models\Contacto\Contacto;
use Illuminate\Database\Seeder;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactos = [
            [
                'nombre' => 'José luis',
                'numero' => '76623762',
                'hijo_id' => 1,
            ],
            [
                'nombre' => 'Mariana Aguilar',
                'numero' => '66327362',
                'hijo_id' => 2,
            ],
            [
                'nombre' => 'Juanita Parraga',
                'numero' => '64563456',
                'hijo_id' => 3,
            ],
            [
                'nombre' => 'Freddy Cruz',
                'numero' => '77782372',
                'hijo_id' => 1,
            ],
            [
                'nombre' => 'Carlos Gutierrez',
                'numero' => '66647434',
                'hijo_id' => 2,
            ],
            [
                'nombre' => 'Zeneida Zaragosa',
                'numero' => '77328232',
                'hijo_id' => 3,
            ],

            [
                'nombre' => 'Carlos luis',
                'numero' => '61623762',
                'hijo_id' => 1,
            ],
            [
                'nombre' => 'Madeleine Aguilar',
                'numero' => '73823291',
                'hijo_id' => 2,
            ],
            [
                'nombre' => 'Juanita Parra',
                'numero' => '71563456',
                'hijo_id' => 3,
            ],
            [
                'nombre' => 'Carla Cruz',
                'numero' => '73212372',
                'hijo_id' => 1,
            ],
            [
                'nombre' => 'Camila Gutierrez',
                'numero' => '77238234',
                'hijo_id' => 2,
            ],
            [
                'nombre' => 'Zeneida Viera',
                'numero' => '62118232',
                'hijo_id' => 3,
            ],

            [
                'nombre' => 'José Linares',
                'numero' => '71123762',
                'hijo_id' => 1,
            ],
            [
                'nombre' => 'Marisol Puma',
                'numero' => '77192993',
                'hijo_id' => 2,
            ],
            [
                'nombre' => 'Catalina Parraga',
                'numero' => '69003456',
                'hijo_id' => 3,
            ],
            [
                'nombre' => 'Freddy Cruz',
                'numero' => '77782372',
                'hijo_id' => 2,
            ],
            [
                'nombre' => 'Carlos Gutierrez',
                'numero' => '66647434',
                'hijo_id' => 2,
            ],
            [
                'nombre' => 'Zeneida Zaragosa',
                'numero' => '77328232',
                'hijo_id' => 1,
            ],
        ];
        foreach ($contactos as $contacto) {
            Contacto::create($contacto);
        }
    }
}
