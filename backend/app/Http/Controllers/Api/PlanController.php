<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planes=Plan::all();
        return response()->json([
          'message'=>'Lista de Planes',
          'data'=>$planes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->user()->tipo;
        $user = User::findOrFail($request->user()->id);
        if ($user->tipo == "A") {
            $validateData = $request->validate([
                'dispositivos' => 'required|numeric|max:20',
                'estado' => 'required|boolean',
                'nombre' => 'required|string|max:40|unique:planes,nombre',
                'precio' => 'required|numeric',
                'tiempo_plan' => 'required|string|max:40',
            ]);

            $plan = Plan::create($request->all());
            return response()->json([
                'message' => '¡Plan creado exitosamente!',
                'data' => $plan
            ], 404);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all()->find(Auth::user()->id);
        if ($user->tipo == "A") {
            $plan = Plan::findOrFail($id);
            return response()->json([
               'message'=>'¡Plan encontrado exitosamente!',
               'data'=>$plan
            ]);
        }else{
            return response()->json([
                'message' => 'Debe ser un Administrador para colocar un nuevo Plan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($request->user()->id);
        if ($user->tipo == "A") {
            $plan = Plan::findOrFail($id);
            $request->validate([
                'dispositivos' => 'required|numeric|max:20',
                'estado' => 'required|boolean',
                'nombre' => 'required|string|max:40',
                'precio' => 'required|numeric',
                'tiempo_plan' => 'required|string|max:40',
            ]);

            $plan->update($request->all());
            return response()->json([
                'message' => '¡Plan actualizado exitosamente!',
                'data' => $plan
            ], 404);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::all()->find(Auth::user()->id);
        if ($user->tipo == "A") {
            $plan = Plan::findOrFail($id);
            $plan->delete();
            return response()->json([
                'message' => '¡Se eliminó el Plan exitosamente!'
            ], 401);
        }else{
            return response()->json([
                'message' => 'Debe ser un Administrador para eliminar un Plan'
            ]);
        }
    }
}
