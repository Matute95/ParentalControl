<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hijo\Hijo;
use App\Models\Localizacion\Localizacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->tipo == "A") {
            $localizaciones = Localizacion::all();
            return response()->json([
                'message' => 'Lista de Localizaciones',
                'data' => $localizaciones
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado para ver listado'
            ], 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        if ($user->tipo == "H") {
            $validateData = $request->validate([
                'gps' => 'required|string'
            ]);
            $localizacion = Localizacion::create([
                'hijo_id' => $user->hijo->id,
                'gps' => $validateData['gps']
            ]);
            return response()->json([
                'message' => '¡Localización creada exitosamente!',
                'data' => $localizacion
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ], 403);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->tipo == "T") {
            $user = User::all()->find(Auth::user()->id);
            $loc = new Collection();
            //return $user->tutor->hijos;
            foreach ($user->tutor->hijos as $hijo) {
                $hijo = Hijo::all()->find($hijo->id);
                $localizaciones = Localizacion::where('hijo_id', $hijo->id)->get();
                foreach ($localizaciones as $localizacion) {
                    $loc->push($localizacion);
                }
            }
            if (isset($loc)) {
                $l = $loc->find($id);
                if (isset($l)) {
                    $l=Localizacion::find($l->id);
                    $l->delete();
                    return response()->json([
                        'message' => '¡Localización eliminada exitosamente!',
                        'data' => $l
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Localización no encontrada'
                    ],403);
                }
            } else {
                return response()->json([
                    'message' => 'Localización no encontrada'
                ],403);
            }
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ], 403);
        }
    }
}
