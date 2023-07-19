<?php

namespace App\Models\Llamada;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contacto\Contacto;


class Llamada extends Model
{
    use HasFactory;

    protected $table = 'llamadas';

    protected $fillable = [
        'aceptada',
        'fecha',
        'tiempo',
        'contacto_id',
    ];


    public function contacto(){

        return $this->belongsTo('App\Models\Contacto\Contacto');
    }
}
