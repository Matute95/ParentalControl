<?php

namespace Database\Seeders;

use App\Models\Localizacion\Localizacion;
use Illuminate\Database\Seeder;

class LocalizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $localizaciones = [
            [
                'hijo_id' => 1,
                'gps' => "longitude:-63.091125, latitude:-17.8028995002",
            ],
            [
                'hijo_id' => 1,
                'gps' => "longitude:-63.0915178999, latitude:-17.8027536002",
            ],
            [
                'hijo_id' => 2,
                'gps' => "longitude:-63.0916626004, latitude:-17.8027173004",
            ],
            [
                'hijo_id' => 2,
                'gps' => "latitude:-17.8026152, longitude:-63.0921586",
            ],
        ];
        foreach ($localizaciones as $localizacion) {
            Localizacion::create($localizacion);
        }
    }
}
