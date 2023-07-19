<?php

namespace Database\Seeders;

use App\Models\Contenido\Contenido;
use Illuminate\Database\Seeder;

class ContenidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contenidos = [
            [
                'fecha'=>'2015-11-01 09:00:00',
                'nombre'=>'image1',
                'path'=>'images/captura/image1.png',
                'url'=>'aws/en-la-nube',
                'categoria_id'=>1,
                'hijo_id'=>1,
            ],
            [
                'fecha'=>'2015-11-01 10:00:00',
                'nombre'=>'image2',
                'path'=>'images/captura/image2.png',
                'url'=>'aws/en-la-nube',
                'categoria_id'=>1,
                'hijo_id'=>2,
            ],
            [
                'fecha'=>'2015-11-01 10:10:00',
                'nombre'=>'image3',
                'path'=>'images/captura/image3.png',
                'url'=>'aws/en-la-nube',
                'categoria_id'=>2,
                'hijo_id'=>2,
            ],
        ];
        foreach ($contenidos as $contenido) {
            Contenido::create($contenido);
        }
    }
}
