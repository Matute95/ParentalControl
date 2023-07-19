<?php

namespace Database\Seeders;

use App\Models\Plan\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planes=[
            [
                'dispositivos'=>1,
                'estado'=>true,
                'nombre'=>'Free',
                'precio'=>0,
                'tiempo_plan'=>'1 mes',
            ],
            [
                'dispositivos'=>3,
                'estado'=>true,
                'nombre'=>'Básico',
                'precio'=>100,
                'tiempo_plan'=>'1 mes',
            ],
            [
                'dispositivos'=>5,
                'estado'=>true,
                'nombre'=>'Premium',
                'precio'=>1000,
                'tiempo_plan'=>'12 meses',
            ],
            [
                'dispositivos'=>5,
                'estado'=>false,
                'nombre'=>'Premium-v',
                'precio'=>1050,
                'tiempo_plan'=>'12 meses',
            ],
        ];
        foreach ($planes as $plan) {
            Plan::create($plan);
        }
    }
}
