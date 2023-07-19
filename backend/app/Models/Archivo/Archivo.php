<?php

namespace App\Models\Archivo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'archivos';

    protected $fillable = [
        'fecha',
        'path',
        'hijo_id',
    ];


    public function hijo(){
          return $this->belongsTo('App\Models\Hijo\Hijo');
    }
}
