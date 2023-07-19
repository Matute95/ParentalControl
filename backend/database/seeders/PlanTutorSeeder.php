<?php

namespace Database\Seeders;

use App\Models\PlanTutor\PlanTutor;
use Illuminate\Database\Seeder;

class PlanTutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planesTutor=[
            [
                'plan_id'=>1,
                'tutor_id'=>1,
                'activo'=>false,
                'fecha_inicio'=>'2021-01-30',
                'fecha_fin'=>'2022-03-01',
            ],
            [
                'plan_id'=>3,
                'tutor_id'=>1,
                'activo'=>false,
                'fecha_inicio'=>'2021-03-02',
                'fecha_fin'=>'2022-03-02',
            ],
            [
                'plan_id'=>3,
                'tutor_id'=>1,
                'activo'=>true,
                'fecha_inicio'=>'2022-03-03',
                'fecha_fin'=>'2023-03-03',
            ]
        ];
        foreach ($planesTutor as $pt) {
            PlanTutor::create($pt);
        }
    }
}
