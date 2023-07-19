<?php

namespace App\Models\Administrativo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\User;

class Administrativo extends Model
{
    use HasFactory;

    protected $table = 'administrativos';

    protected $guarded=['id','created_at','updated_at'];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
