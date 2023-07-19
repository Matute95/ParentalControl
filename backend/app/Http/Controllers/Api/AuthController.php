<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hijo\Hijo;
use App\Models\Tutor\Tutor;
use App\Models\User;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function index()
    {
        /* $user = User::findOrFail(Auth::user()->id);
        if ($user->tipo == "A") {
            return response()->json([
               'message'=>'Lista de Usuarios',
               'data'=>User::all()
            ]);
        } else {
            return response()->json([
                'message' => 'Debe ser un usuario administrador para ver todos los usuarios'
            ]);
        }*/
      
        return response()->json([
            'message' => 'Lista de Usuarios',
            'data' => User::all()
        ]);
    }
    public function registerAdmin(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:1',
            'celular' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|confirmed|string|min:8',
            'foto' =>  'mimes:jpg,jpeg,bmp,png|max:2048|nullable'
        ]);
        $url = null;
        if ($request->hasFile('foto')) {

            $folder = "public/perfil";
            $imagen = $request->file('foto')->store($folder); //Storage::disk('local')->put($folder, $request->image, 'public');
            $url = Storage::url($imagen);
        }
        $user = User::create([
            'name' => $validateData['name'],
            'apellido' => $validateData['apellido'],
            'fecha_nacimiento' => $validateData['fecha_nacimiento'],
            'sexo' => $validateData['sexo'],
            'celular' => $validateData['celular'],
            'tipo' => "A",
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
            'foto' => $url
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function registerTutor(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:1',
            'celular' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|confirmed|string|min:8',
            'habilitado' => 'nullable|boolean',
            'foto' =>  'mimes:jpg,jpeg,bmp,png|max:2048|nullable'
        ]);
        $url = null;
        if ($request->hasFile('foto')) {
            $folder = "public/perfil";
            $imagen = $request->file('foto')->store($folder); //Storage::disk('local')->put($folder, $request->image, 'public');
            $url = Storage::url($imagen);
        }
        $user = User::create([
            'name' => $validateData['name'],
            'apellido' => $validateData['apellido'],
            'fecha_nacimiento' => $validateData['fecha_nacimiento'],
            'sexo' => $validateData['sexo'],
            'celular' => $validateData['celular'],
            'tipo' => "T",
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
            'foto' => $url
        ]);
        $t = Tutor::create([
            'user_id' => $user->id
        ]);
        //return $t;
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    public function registerHijo(Request $request)
    {
        $u = User::findOrFail($request->user()->id);
        if ($u->tipo == "T") {
            $validateData = $request->validate([
                'name' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                'sexo' => 'required|string|max:1',
                'celular' => 'required|numeric',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|confirmed|string|min:8',
                'habilitado' => 'nullable|boolean',
                'foto' =>  'mimes:jpg,jpeg,bmp,png|max:2048|nullable',
                'edad' => 'required|numeric',
                'alias' => 'required|string|max:40',
            ]);
            $url = null;
            if ($request->hasFile('foto')) {
                $folder = "public/perfil";
                $imagen = $request->file('foto')->store($folder); //Storage::disk('local')->put($folder, $request->image, 'public');
                $url = Storage::url($imagen);
            }
            $user = User::create([
                'name' => $validateData['name'],
                'apellido' => $validateData['apellido'],
                'fecha_nacimiento' => $validateData['fecha_nacimiento'],
                'sexo' => $validateData['sexo'],
                'celular' => $validateData['celular'],
                'tipo' => "H",
                'email' => $validateData['email'],
                'password' => bcrypt($validateData['password']),
                'foto' => $url
            ]);
            $hijo = Hijo::create([
                'alias' => $validateData['alias'],
                'user_id' => $user->id,
                'tutor_id' => Auth::user()->tutor->id,
                'edad' => $validateData['edad']
            ]);
            //$token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => '¡Usuario hijo creado exitosamente!',
                'data' => ['user' => $user, 'hijo' => $hijo],
            ]);
        } else {
            return response()->json([
                'message' => 'Debe ser usuario Tutor'
            ]);
        }
    }
    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Email o contraseña incorrecto'
            ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'message' => 'Datos del Usuario',
            'data' => $request->user(),
        ]);
    }

    public function tutor(Request $request)
    {
        $user = User::findOrFail($request->user()->id);

        if ($user->tipo == "T") {
            $tutor = Tutor::all()->find($user->tutor->id);
            $tutor->user;

            return response()->json([
                'message' => 'Datos del tutor',
                'data' => $tutor
            ]);
        } else {
            return response()->json([
                'message' => 'Debes ser un usuario Tutor'
            ], 404);
        }
    }
    
    public function tutorHijo(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        if ($user->tipo == "H") {
            $hijo = Hijo::all()->find($user->hijo->id);
            $tutor = Tutor::all()->find($hijo->tutor->id);
            $tutor->user;
            return response()->json([
                'message' => 'Tutor del usuario hijo',
                'data' => $tutor
            ]);
        } else {
            return response()->json([
                'message' => 'Debe ser usuario hijo para ver su tutor'
            ], 404);
        }
    }
    public function hijo(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        if ($user->tipo == "H") {
            $hijo = Hijo::all()->find($user->hijo->id);
            $hijo->user;
            return response()->json([
                'message' => 'Datos del hijo',
                'data' => $hijo
            ]);
        } else {
            return response()->json([
                'message' => 'Debes ser un usuario hijo'
            ], 404);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "msg" => "Cierre de Sesión",
            "data" => $request->user()
        ]);
    }
}
