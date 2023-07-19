<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contacto\Contacto;
use App\Models\Contenido\Contenido;
use App\Models\Hijo\Hijo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{

    public function hijoContactos($id)
    {
        $user = Auth::user();
        if ($user->tipo == "T") {
            $hijo = Hijo::findOrFail($id);
            return response()->json([
                'message' => 'Lista de Contactos del hijo',
                'data' => $hijo->contactos
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ], 403);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:40',
            'numero' => 'required|string|max:20',
            'hijo_id' => 'required|exists:hijos,id'
        ]);
        $contacto = Contacto::create($request->all());
        return response()->json([
            'message' => '¡Contacto creado exitosamente!',
            'data' => $contacto
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->tipo == "T") {
            $request->validate([
                'nombre' => 'required|string|max:40',
                'numero' => 'required|string|max:20',
                'hijo_id' => 'required|exists:hijos,id'
            ]);
            $contacto = Contacto::findOrFail($id);
            if (isset($contacto)) {
                $contacto->update($contacto);
                return response()->json([
                    'message' => '¡Contacto actualizado exitosamente!',
                    'data' => $contacto
                ]);
            } else {
                return response()->json([
                    'message' => 'Error contacto no existe'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ]);
        }
    }
    public function show($id)
    {
        $user = Auth::user();
        if ($user->tipo == "T") {
            $contacto = Contacto::findOrFail($id);
            if(isset($contacto)){
                return response()->json([
                    'message' => '¡Contacto encontrado!',
                    'data' => $contacto
                ]);
            }else{
                return response()->json([
                    'message' => 'Error contacto no existe'
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
        $user = Auth::user();
        if ($user->tipo == "T") {
            $contacto = Contacto::all()->find($id);
            if (isset($contacto)){
                $contacto->delete();
                return response()->json([
                    'message' => '¡Contacto eliminado exitosamente!',
                    'data' => $contacto
                ]);
            }else{
                return response()->json([
                    'message' => 'Error contacto no existe'
                ], 403);
            }
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ], 403);
        }
    }
}
