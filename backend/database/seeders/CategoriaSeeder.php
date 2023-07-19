<?php

namespace Database\Seeders;

use App\Models\Categoria\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias=[
            [
                'nombre'=>'violencia',
                'parent_name'=>'violence',
            ],
            [
                'nombre'=>'sexual',
                'parent_name'=>'sexual',
            ]
        ];
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
