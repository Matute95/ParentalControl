<?php

namespace Database\Seeders;

use App\Models\Administrativo\Administrativo;
use App\Models\Hijo\Hijo;
use App\Models\Tutor\Tutor;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => "Christian",
                'email' => "christian@gmail.com",
                'apellido' => "Mamani",
                'celular' => "77348732",
                'fecha_nacimiento' => "2000/01/04",
                'sexo' => "M",
                'tipo' => "A",
                'password' => bcrypt("12345678")
            ],
            [
                'name' => "Rister",
                'email' => "rister@gmail.com",
                'apellido' => "Cuellar",
                'celular' => "78237322",
                'fecha_nacimiento' => "2000/08/01",
                'sexo' => "M",
                'tipo' => "A",
                'password' => bcrypt("12345678")
            ],
            [
                'name' => "Junior",
                'email' => "junior@gmail.com",
                'apellido' => "Llanos",
                'celular' => "67236323",
                'fecha_nacimiento' => "2000/12/14",
                'sexo' => "M",
                'tipo' => "A",
                'password' => bcrypt("12345678")
            ],
            [
                'name' => "Pablo",
                'email' => "pablo@gmail.com",
                'apellido' => "Marmol",
                'celular' => "66637322",
                'fecha_nacimiento' => "1997/01/04",
                'sexo' => "M",
                'tipo' => "T",
                'password' => bcrypt("12345678")
            ],
         
        ];
        foreach ($users as $user) {
            User::create($user);
        }
        $users = User::all();
        $admins = $users->where('tipo', 'A');
        $tutors = $users->where('tipo', 'T');
        //$hijos = $users->where('tipo', 'H');
        $c = 0;
        foreach ($admins as $admin) {
            Administrativo::create(['user_id' => $admin->id]);
        }

        $t=Tutor::create([
            'user_id' => $tutors->first()->id,
        ]);
        $hijos=[
            [
                'name'=>'Joselito',
                'apellido'=>'Vaca',
                'celular'=>'77656344',
                'sexo'=>'M',
                'alias'=>'josesiño',
                'edad'=>8,
                'tutore_id'=>$t->id
            ],
            [
                'name'=>'Mariana',
                'apellido'=>'Ipi',
                'celular'=>'65633214',
                'sexo'=>'F',
                'alias'=>'mary',
                'edad'=>6,
                'tutore_id'=>$t->id
            ],
            [
                'name'=>'Carlos',
                'apellido'=>'Perez',
                'celular'=>'74412243',
                'sexo'=>'M',
                'alias'=>'carliño',
                'edad'=>5,
                'tutore_id'=>$t->id
            ],
        ];
        foreach ($hijos as $hijo) {
            Hijo::create($hijo);   
        }

        /*Hijo::create([
            'alias' => 'sarita',
            'edad' => 18,
            'user_id' => $hijos->first()->id,
            'tutor_id' => 1
        ]);
        Hijo::create([
            'alias' => 'joss',
            'edad' => 18,
            'user_id' => $hijos->last()->id,
            'tutor_id' => 1
        ]);*/
    }
}
