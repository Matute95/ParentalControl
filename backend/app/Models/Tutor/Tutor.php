<?php

namespace App\Models\Tutor;

use App\Models\Hijo\Hijo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan\Plan;
use App\Models\User;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutores';

    protected $guarded=['id','created_at','updated_at'];

    
    /*public function planes(){
        // LA TABLA PLAN TUTOR ES LA MISMA TABLE QUE SUSCRIPCION
        //return this->belongsToMany(Plan::class,'plan_tutor');
*/
    public function planesTutor()
    {
        return $this->hasMany('App\Models\PlanTutor\PlanTutor','tutore_id','id');
    }
    //relación inversa de 1 a muchos
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relación de 1 a muchos
    public function hijos(){
        return $this->hasMany(Hijo::class,'tutore_id','id');
    }


}
