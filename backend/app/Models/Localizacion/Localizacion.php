<?php

namespace App\Models\Localizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hijo\Hijo;


class Localizacion extends Model
{
    use HasFactory;

    protected $table = 'localizaciones';

    protected $fillable = [
        'hijo_id',
        'gps',
    ];


    public function hijo()
    {

        //return $this->hasOne(Hijo::class,'id','hijo_id');
        return $this->belongsTo('App\Models\Hijo\Hijo');
    }
}
