<?php

namespace App\Models\PlanTutor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanTutor extends Model
{
    use HasFactory;


    protected $table ='plan_tutor';


    protected $fillable = [
        'plan_id',
        'tutor_id',
        'activo',
        'fecha_inicio',
        'fecha_fin',
    ];
    public function plan(){
        return $this->BelongsTo('App\Models\Plan\Plan');
    }
    public function tutor(){
        return $this->BelongsTo('App\Models\Tutor\Tutor');
    }
}
