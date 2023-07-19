<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Lista de Categorias',
            'data' => Categoria::all()
        ]);
    }
    public function store(Request $request)
    {
        if (Auth::user()->tipo == "A" || Auth::user()->tipo == "T") {
            $request->validate([
                'nombre' => 'required|string|max:40',
                'parentname' => 'required|string|max:40'
            ]);
            $categoria = Categoria::create($request->all());
            return response()->json([
                'message' => '¡Categoria creada exitosamente!',
                'data' => $categoria
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no autorizado'
            ]);
        }
    }
    public function show($id)
    {

        $categoria = Categoria::findOrFail($id);
        if (isset($categoria)) {
            return response()->json([
                'message' => '¡Categoria encontrada exitosamente!',
                'data' => $categoria
            ]);
        } else {
            return response()->json([
                'message' => 'Error categoria no existe'
            ]);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:40',
            'parentname' => 'required|string|max:40'
        ]);
        $categoria = Categoria::findOrFail($id);
        if (isset($categoria)) {
            $categoria->update($request);
            return response()->json([
                'message' => '¡Categoría actualizada exitosamente!',
                'data' => $categoria
            ]);
        } else {
            return response()->json([
                'message' => '¡Error categoría no encontrada!'
            ], 403);
        }
    }

    public function destroy($id)
    {

        $categoria = Categoria::findOrFail($id);
        if (isset($categoria)) {
            $categoria->delete();
            return response()->json([
                'message' => '¡Categoría eliminada exitosamente!',
                'data' => $categoria
            ]);
        } else {
            return response()->json([
                'message' => '¡Error categoría no encontrada!'
            ], 403);
        }
    }
}
