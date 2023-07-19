<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=['id','created_at','updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    /*protected $hidden = [
        'password',
        'remember_token',
        
    ];
*/
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function tutor(){
        return $this->hasOne('App\Models\Tutor\Tutor','user_id','id');
    }
    public function hijo(){
        return $this->hasOne('App\Models\Hijo\Hijo','user_id','id');
    }
    public function admin(){
        return $this->hasOne('App\Models\Administrativo\Administrativo','user_id','id');
    }
}
