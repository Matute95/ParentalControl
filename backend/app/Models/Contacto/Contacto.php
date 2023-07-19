<?php

namespace App\Models\Contacto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = 'contactos';

    protected $fillable = [
        'nombre',
        'numero',
        'hijo_id',
    ];

    public function hijo(){
return $this->belongsTo('App\Models\Hijo\Hijo');
    }
    public function llamadas(){
        return $this->hasMany('App\Models\Llamada\Llamada','contacto_id','id');
    }
}
