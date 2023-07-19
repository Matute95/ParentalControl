<?php

namespace Database\Seeders;

use App\Models\Archivo\Archivo;
use Illuminate\Database\Seeder;

class ArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $archivos = [
            [
                'fecha' => '2015-11-01 10:10:00',
                'path' => 'http://pm1.narvii.com/7119/b0abdf491cffde4bdf95850956c1b15a5591a4b5r1-712-707v2_uhq.jpg',
                'hijo_id' => 1,
            ],
            [
                'fecha' => '2015-11-01 12:10:00',
                'path' => 'https://i.ytimg.com/vi/lQUQ-DOX4jM/maxresdefault.jpg',
                'hijo_id' => 2,
            ],
            [
                'fecha' => '2015-11-01 14:10:00',
                'path' => 'https://i.pinimg.com/550x/e2/08/fd/e208fd2f6a946387a4c7e62240fe08f8.jpg',
                'hijo_id' => 1,
            ],
            [
                'fecha' => '2015-11-01 16:10:00',
                'path' => 'https://pbs.twimg.com/media/D6uc2kBX4AAv3xV.jpg',
                'hijo_id' => 2,
            ],

            [
                'fecha' => '2015-11-02 10:10:00',
                'path' => 'https://pbs.twimg.com/profile_images/1328322484685385728/JTO6EuoS_400x400.jpg',
                'hijo_id' => 1,
            ],
            [
                'fecha' => '2015-11-02 12:10:00',
                'path' => 'https://production.listennotes.com/podcasts/el-podcast-m%C3%A1s-random-del-mundo-L6I3Ep9lRTB-xB_PCg0EDch.1400x1400.jpg',
                'hijo_id' => 2,
            ],
            [
                'fecha' => '2015-11-02 14:10:00',
                'path' => 'https://i.ytimg.com/vi/6Kc2GqcXcjU/maxresdefault.jpg',
                'hijo_id' => 1,
            ],
            [
                'fecha' => '2015-11-02 16:10:00',
                'path' => 'https://tresubresdobles.com/wp-content/uploads/2019/08/skft-912381dcd5b2c45c4a9ce8acf32cfd8c-768x961.jpg',
                'hijo_id' => 2,
            ],

            [
                'fecha' => '2015-11-01 10:10:00',
                'path' => ' https://pbs.twimg.com/profile_images/1455376999690776587/rXVFX3e9_400x400.jpg',
                'hijo_id' => 3,
            ],
            [
                'fecha' => '2015-11-01 12:10:00',
                'path' => 'https://cdnb.artstation.com/p/users/avatars/004/890/615/large/48730a8a755ea627b8b71cfe01b75b75.jpg',
                'hijo_id' => 3,
            ],
            [
                'fecha' => '2015-11-01 14:10:00',
                'path' => 'http://images3.memedroid.com/images/UPLOADED231/5eb0dd3b654b6.jpeg',
                'hijo_id' => 3,
            ],
            [
                'fecha' => '2015-11-01 16:10:00',
                'path' => ' https://i.pinimg.com/236x/55/ec/80/55ec80d3109c588604aa4a1de4d93b3e.jpg',
                'hijo_id' => 3,
            ],
        ];
        foreach ($archivos as $archivo) {
            Archivo::create($archivo);
        }
    }
}
