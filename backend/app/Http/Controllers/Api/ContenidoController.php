<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contenido\Contenido;
use App\Models\Hijo\Hijo;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContenidoController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Lista de Contenido',
            'data' => Contenido::all()
        ]);
    }
    public function contenidoHijo($id)
    {
        $hijo = Hijo::findOrFail($id);
        $contenidos = $hijo->contenidos;
        return response()->json([
            'message' => 'Lista de Contenido del hijo',
            'data' => $contenidos
        ]);
    }
    public function contenidoHijos()
    {
        $user = User::all()->find(Auth::user()->id);
        if ($user->tipo == "T") {

            $uc = new Collection();
            foreach ($user->tutor->hijos as $hijo) {
                $con = new Collection();
                $hijo = Hijo::all()->find($hijo->id);
                $contenidos = Contenido::where('hijo_id', $hijo->id)->get();
                foreach ($contenidos as $contenido) {
                    $con->push($contenido);
                }
                $uc->push([
                    'hijo' => $hijo,
                    'contenidos' => $con
                ]);
            }
            return response()->json([
                'message' => 'Contenidos de los hijos',
                'data' => $uc
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ]);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'hijo_id' => 'required|numeric|exists:hijos,id',
            'fecha' => 'required|string',
            'nombre' => 'required|string',
            'path' => 'required|string',
            'url' => 'required|string',
            'categoria_id' => 'required|numeric|exists:categorias,id',

        ]);
        $contenido = Contenido::create($request->all());
        return response()->json([
            'message' => '¡Contenido creado exitosamente!',
            'data' => $contenido
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'hijo_id' => 'nullable|numeric|exists:hijos,id',
            'fecha' => 'required|string',
            'nombre' => 'required|string',
            'path' => 'required|string',
            'url' => 'required|string',
            'categoria_id' => 'nullable|numeric|exists:categorias,id',
        ]);
        $contenido = Contenido::findOrFail($id);
        if (isset($contenido)) {
            $contenido->update($request->all());
            return response()->json([
                'message' => '¡Contenido actualizado exitosamente!',
                'data' => $contenido
            ]);
        } else {
            return response()->json([
                'message' => 'Error contenido no existe'
            ], 403);
        }
    }
    public function show($id)
    {
        $user = Auth::user();
        if ($user->tipo == "T") {
            $contenido = Contenido::findOrFail($id);
            if (isset($contenido)) {
                return response()->json([
                    'message' => '¡Contenido encontrado exitosamente!',
                    'data' => $contenido
                ]);
            } else {
                return response()->json([
                    'message' => 'Error contenido no existe'
                ], 403);
            }
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ], 403);
        }
    }
    public function destroy($id)
    {
        $contenido = Contenido::findOrFail($id);
        if (isset($contenido)) {
            $contenido->delete();
            return response()->json([
                'message' => '¡Contenido eliminado exitosamente!',
                'data' => $contenido
            ]);
        } else {
            return response()->json([
                'message' => 'Error contenido no existe'
            ], 403);
        }
    }
}
