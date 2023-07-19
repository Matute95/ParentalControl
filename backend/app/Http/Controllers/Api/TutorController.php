<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hijo\Hijo;
use App\Models\Tutor\Tutor;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TutorController extends Controller
{
    public function update(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        if ($user->tipo == "T") {
            $validateData = $request->validate([
                'name' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                'sexo' => 'required|string|max:1',
                'celular' => 'required|numeric',
                'email' => 'required|string|email|max:255',
                'password' => 'required|confirmed|string|min:8',
                'habilitado' => 'nullable|boolean',
                'foto' =>  'mimes:jpg,jpeg,bmp,png|max:2048|nullable'
            ]);
            $url = null;
            $user = User::findOrFail($request->user()->id);
            if ($request->hasFile('foto')) {
                $folder = "public/perfil";
                if ($user->foto != null) { //si entra es para actualizar su foto borrando la que tenía, si no tenía entonces no entra
                    Storage::delete($user->foto);
                }
                $imagen = $request->file('foto')->store($folder); //Storage::disk('local')->put($folder, $request->image, 'public');
                $url = Storage::url($imagen);
                $user->foto = $url;
            }
            $user->name = $validateData['name'];
            $user->apellido = $validateData['apellido'];
            $user->fecha_nacimiento = $validateData['fecha_nacimiento'];
            $user->sexo = $validateData['sexo'];
            $user->celular = $validateData['celular'];
            $user->email = $validateData['email'];
            $user->password = bcrypt($validateData['password']);
            // $user->foto = $url;
            $user->save();

            $tutor = $user->tutor;
            if (isset($request->habilitado)) {
                $tutor->habilitado = $request->habilitado;
            }

            $tutor->save();
            //return $t;
            //token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Datos de usuario actualizado exitosamente',
                'data' => ['user' => $user, 'tutor' => $tutor]
            ]);
        } else {
            return response()->json([
                'message' => 'Debe ser un usuario tutor para actualizar los datos'
            ], 404);
        }
    }
    public function hijosTutor(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        if ($user->tipo == 'T') {
            $h = new Collection();
            foreach ($user->tutor->hijos as $hijo) {
                $hijo = Hijo::all()->find($hijo->id);
                $hijo->user;
                $h->push($hijo);
            }
            return response()->json([
                'message' => 'Hijos del tutor',
                'data' => $h
            ]);
        } else {
            return response()->json([
                'message' => 'Debes ser tutor para ver tus hijos'
            ], 404);
        }
    }
    public function destroy()
    {
        $user = User::all()->find(Auth::user()->id);
        if ($user->tipo == "T") {
            $user->delete();
            return response()->json([
                'message' => "Se eliminó su exitosamente",
                'data' => $user
            ]);
        } else {

            return response()->json([
                'message' => "Debe ser un usuario Tutor para eliminar"
            ]);
        }
    }
}
