<?php

namespace App\Models\Plan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tutor\Tutor;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'planes';


    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function planesTutor()
    {
        return $this->hasMany('App\Models\PlanTutor\PlanTutor','plan_id','id');
    }
}
