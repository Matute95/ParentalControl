<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanTutorController extends Controller
{
    public function planTutor()
    {
        $user = Auth::user();
        $user = User::all()->find($user->id);
        if ($user->tipo == "T") {
            $tutor = $user->tutor;
            return response()->json([
                'message' => 'Lista de planes del tutor',
                'data' => $tutor->planesTutor
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ]);
        }
    }
    public function planActivo(){
        $user = Auth::user();
        $user = User::all()->find($user->id);
        if ($user->tipo == "T") {
            $tutor = $user->tutor;
            $plan=$tutor->planesTutor->where('activo',true)->first();

            return response()->json([
                'message' => 'Plan activo del tutor',
                'data' => $plan
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ]);
        }
    }
}
