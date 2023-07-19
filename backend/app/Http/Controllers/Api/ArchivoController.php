<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Archivo\Archivo;
use App\Models\Hijo\Hijo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchivoController extends Controller
{
    public function archivosHijo($id)
    {
        $user = Auth::user();
        if ($user->tipo == "T") {
            $hijo = Hijo::findOrFail($id);
            $archivos = $hijo->archivos;
            return response()->json([
                'message' => 'Lista de Archivos de la carpeta',
                'data' => $archivos
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
            'fecha' => 'required|date',
            'path' => 'required|string',
            'hijo_id' => 'required|exists:hijos,id',
        ]);
        $archivo = Archivo::create($request->all());
        return response()->json([
            'message' => '¡Archivo creado exitosamente!',
            'data' => $archivo
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'path' => 'required|string',
            'hijo_id' => 'required|exists:hijos,id',
        ]);
        $archivo = Archivo::findOrFail($id);
        if (isset($archivo)) {
            $archivo->update($request->all());
            return response()->json([
                'message' => '¡archivo actualizada exitosamente!',
                'data' => $archivo
            ]);
        } else {
            return response()->json([
                'message' => 'Error Archivo no existe'
            ], 403);
        }
    }
    public function show($id)
    {
        $archivo = Archivo::findOrFail($id);
        if (isset($archivo)) {
            return response()->json([
                'message' => '¡Archivo encontrado exitosamente!',
                'data' => $archivo
            ]);
        } else {
            return response()->json([
                'message' => 'Error archivo no existe'
            ], 403);
        }
    }
    public function destroy($id)
    {
        $user = Auth::user();
        if (isset($user)) {
            $archivo = Archivo::findOrFail($id);
            if (isset($archivo)) {
                $archivo->delete();
                return response()->json([
                    'message' => '¡Archivo eliminado exitosamente!',
                    'data' => $archivo
                ]);
            } else {
                return response()->json([
                    'message' => 'Error archivo no existe'
                ], 403);
            }
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ], 403);
        }
    }
}
