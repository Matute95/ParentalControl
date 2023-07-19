<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Hijo\Hijo;
use Illuminate\Http\Request;
use App\Models\Contenido\Contenido;
use App\Models\Contacto\Contacto;
use App\Models\Localizacion\Localizacion;
use App\Http\Controllers\Controller;
use App\Models\Archivo\Archivo;
use Illuminate\Support\Facades\Auth;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class HijoController extends Controller
{
    public function index()
    {
        $hijos = Hijo::all();
        $h = new Collection();
        foreach ($hijos as $hijo) {
            $hijo->user;
            $h->push($hijo);
        }
        return response()->json([
            'message' => 'Lista de usuarios hijos',
            'data' => $h
        ]);
    }
    public function showHijo($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->tipo == "T") {
            $hijo = Hijo::findOrFail($id);

            if (isset($hijo)) {
                $hijo->user;
                return response()->json([
                    'message' => '¡Se encontró el usuario hijo',
                    'data' => $hijo
                ]);
            } else {
                return response()->json([
                    'message' => 'Error no se encuentra el usuario hijo'
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Debe ser un usuario tutor para ver los datos de su hijo'
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $u = User::findOrFail($request->user()->id);
        if ($u->tipo == "T") {
            $validateData = $request->validate([
                'name' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'fecha_nacimiento' => 'required|date',
                'sexo' => 'required|string|max:1',
                'celular' => 'required|numeric',
                'email' => 'required|string|email|max:255',
                'password' => 'required|confirmed|string|min:8',
                'foto' =>  'mimes:jpg,jpeg,bmp,png|max:2048|nullable',
                'edad' => 'required|numeric',
                'alias' => 'required|string|max:40'
            ]);
            $url = null;
            $hijo = Hijo::findOrFail($id);
            if (isset($hijo)) {
                $user = $hijo->user;
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

                $hijo->alias = $validateData['alias'];
                $hijo->edad = $validateData['edad'];
                $hijo->save();
                //return $t;
                //token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'message' => 'Datos de usuario actualizado exitosamente',
                    'data' => ['user' => $user, 'hijo' => $hijo]
                ]);
            } else {
                return response()->json([
                    'message' => 'Error no se encuentra el usuario hijo'
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Debe ser un usuario tutor para actualizar los datos'
            ], 404);
        }
    }
    public function destroyHijo($id)
    {
        $u = User::all()->find(Auth::user()->id);
        if ($u->tipo == "T") {
            $hijo = Hijo::findOrFail($id);
            if (isset($hijo)) {
                $user = User::all()->find($hijo->user_id);
                $user->delete();
                return response()->json([
                    'message' => "Se eliminó exitosamente",
                    'data' => $user
                ]);
            } else {
                return response()->json([
                    'message' => "Error no se encontró el usuario del hij@"
                ]);
            }
        } else {

            return response()->json([
                'message' => "Usuario no autorizado"
            ]);
        }
    }
    public function localizacionesHijo($id)
    { //id del hijo
        if (Auth::user()->tipo == "T") {
            $hijo = Hijo::findOrFail($id);
            if (isset($hijo)) {
                return response()->json([
                    'message' => 'Localizaciones del hijo',
                    'data' => $hijo->localizaciones
                ]);
            } else {
                return response()->json([
                    'message' => 'Error no se encontro el usuario hijo'
                ]);
            }
        } else {
            return response()->json([
                'message' => "Usuario no autorizado"
            ]);
        }
    }


    //TODO: Funcion para el reconocimiento de imagenes inadecuadas DE LA CAMARA

    public function controlImagen(Request $request)
    {

        if ($request->hasFile('fotos')) {

            $client = new RekognitionClient([
                'region' => 'us-east-1',
                'version' => 'latest'
            ]);

            /* OBTENIENDO LA IMG */
            $image = fopen($request->file('fotos')->getPathName(), 'r');
            $bytes = fread($image, $request->file('fotos')->getSize());


            /* CONSULTANDO EL SERVICIO DE AWS */

            $result = $client->detectModerationLabels([

                'Image' => ['Bytes' => $bytes],
                'MinConfidence' => 51

            ]);
            $resultLabels = $result->get('ModerationLabels');



            if ($resultLabels !== []) {

                try {
                    $nombre = $request->file('fotos')->getClientOriginalName();
                    // guardando foto inadecuada del infante en BD y S3
                    $folder = "infante";
                    $guardarFoto = new Contenido;

                    $imageRuta = Storage::disk('s3')->put($folder, $request->fotos, 'public');

                    $guardarFoto->fecha = Carbon::now();
                    $guardarFoto->path = 'DCIM/Camera/' . $nombre;

                    //Onteniendo datos del tipo de contenido
                    //  dd($resultLabels[1]);

                    //  dd($resultLabels[1]["ParentName"]);
                    if ($resultLabels[1]["ParentName"] == "Explicit Nudity" || $resultLabels[1]["ParentName"] == "Suggestive") {
                        $parentName = $resultLabels[1]["ParentName"];
                        $name = $resultLabels[1]["Name"];
                    } else {
                        $parentName = $resultLabels[0]["ParentName"];
                        $name = $resultLabels[0]["Name"];
                    }
                    $guardarFoto->url = $imageRuta;
                    $guardarFoto->tipo_contenido = $parentName; //PARENT NAME DE AWS
                    $guardarFoto->contenido = $name;  // NAME DE AWS
                    $guardarFoto->hijo_id = 1;



                    $guardarFoto->save();
                } catch (\Exception $e) {
                    dd($e);
                }
            }


            return response()->json([
                'message' => "Imagen subida",
                'data' => $resultLabels,
            ]);
        }
    }


    //TODO: FUNCION  PARA OBTENER LOS DISTINTOS ARCHIVOS DEL INFANTE

    public function StorageDocumento(Request $request)
    {

        if ($request->hasFile('fotos')) {
            try {
                $nombre = $request->file('fotos')->getClientOriginalName();

                $storageDoc = new Archivo;
                $storageDoc->fecha = Carbon::now();
                $storageDoc->path = "Storage/Documents/".$nombre;
                $storageDoc->hijo_id = 1;
                $storageDoc->save();
            } catch (\Exception $e) {
                dd($e);
            }

            return response()->json([
                'message' => "Archivo subido",
                'data' => $nombre,
            ]);
        }
    }

    //TODO: Funcion para el reconocimiento de imagenes inadecuadas DE DESCARGAS

    public function storageDescarga(Request $request)
    {

        if ($request->hasFile('fotos')) {

            $client = new RekognitionClient([
                'region' => 'us-east-1',
                'version' => 'latest'
            ]);

            /* OBTENIENDO LA IMG */
            $image = fopen($request->file('fotos')->getPathName(), 'r');
            $bytes = fread($image, $request->file('fotos')->getSize());


            /* CONSULTANDO EL SERVICIO DE AWS */

            $result = $client->detectModerationLabels([

                'Image' => ['Bytes' => $bytes],
                'MinConfidence' => 51

            ]);
            $resultLabels = $result->get('ModerationLabels');



            if ($resultLabels !== []) {

                try {
                    $nombre = $request->file('fotos')->getClientOriginalName();
                    // guardando foto inadecuada del infante en BD y S3
                    $folder = "infante";
                    $guardarFoto = new Contenido;

                    $imageRuta = Storage::disk('s3')->put($folder, $request->fotos, 'public');

                    $guardarFoto->fecha = Carbon::now();
                    $guardarFoto->path = 'Storage/Descarga/' . $nombre;

                    //Onteniendo datos del tipo de contenido
                    //  dd($resultLabels[1]);

                    //  dd($resultLabels[1]["ParentName"]);
                    if ($resultLabels[1]["ParentName"] == "Explicit Nudity" || $resultLabels[1]["ParentName"] == "Suggestive") {
                        $parentName = $resultLabels[1]["ParentName"];
                        $name = $resultLabels[1]["Name"];
                    } else {
                        $parentName = $resultLabels[0]["ParentName"];
                        $name = $resultLabels[0]["Name"];
                    }
                    $guardarFoto->url = $imageRuta;
                    $guardarFoto->tipo_contenido = $parentName; //PARENT NAME DE AWS
                    $guardarFoto->contenido = $name;  // NAME DE AWS
                    $guardarFoto->hijo_id = 1;



                    $guardarFoto->save();
                } catch (\Exception $e) {
                    dd($e);
                }
            }


            return response()->json([
                'message' => "Imagen subida",
                'data' => $resultLabels,
            ]);
        }
    }

    //TODO: Funcion para el reconocimiento de imagenes inadecuadas DE FACEBOOk

    public function storageFacebook(Request $request)
    {

        if ($request->hasFile('fotos')) {

            $client = new RekognitionClient([
                'region' => 'us-east-1',
                'version' => 'latest'
            ]);

            /* OBTENIENDO LA IMG */
            $image = fopen($request->file('fotos')->getPathName(), 'r');
            $bytes = fread($image, $request->file('fotos')->getSize());


            /* CONSULTANDO EL SERVICIO DE AWS */

            $result = $client->detectModerationLabels([

                'Image' => ['Bytes' => $bytes],
                'MinConfidence' => 51

            ]);
            $resultLabels = $result->get('ModerationLabels');



            if ($resultLabels !== []) {

                try {
                    $nombre = $request->file('fotos')->getClientOriginalName();
                    // guardando foto inadecuada del infante en BD y S3
                    $folder = "infante";
                    $guardarFoto = new Contenido;

                    $imageRuta = Storage::disk('s3')->put($folder, $request->fotos, 'public');

                    $guardarFoto->fecha = Carbon::now();
                    $guardarFoto->path = 'Storage/DCIM/Facebook/' . $nombre;

                    //Onteniendo datos del tipo de contenido
                    //  dd($resultLabels[1]);

                    //  dd($resultLabels[1]["ParentName"]);
                    if ($resultLabels[1]["ParentName"] == "Explicit Nudity" || $resultLabels[1]["ParentName"] == "Suggestive") {
                        $parentName = $resultLabels[1]["ParentName"];
                        $name = $resultLabels[1]["Name"];
                    } else {
                        $parentName = $resultLabels[0]["ParentName"];
                        $name = $resultLabels[0]["Name"];
                    }
                    $guardarFoto->url = $imageRuta;
                    $guardarFoto->tipo_contenido = $parentName; //PARENT NAME DE AWS
                    $guardarFoto->contenido = $name;  // NAME DE AWS
                    $guardarFoto->hijo_id = 1;



                    $guardarFoto->save();
                } catch (\Exception $e) {
                    dd($e);
                }
            }


            return response()->json([
                'message' => "Imagen subida",
                'data' => $resultLabels,
            ]);
        }
    }
     //TODO: Funcion para el reconocimiento de imagenes inadecuadas DE TELEGRAM

     public function storageTelegram(Request $request)
     {

         if ($request->hasFile('fotos')) {

             $client = new RekognitionClient([
                 'region' => 'us-east-1',
                 'version' => 'latest'
             ]);

             /* OBTENIENDO LA IMG */
             $image = fopen($request->file('fotos')->getPathName(), 'r');
             $bytes = fread($image, $request->file('fotos')->getSize());


             /* CONSULTANDO EL SERVICIO DE AWS */

             $result = $client->detectModerationLabels([

                 'Image' => ['Bytes' => $bytes],
                 'MinConfidence' => 51

             ]);
             $resultLabels = $result->get('ModerationLabels');



             if ($resultLabels !== []) {

                 try {
                     $nombre = $request->file('fotos')->getClientOriginalName();
                     // guardando foto inadecuada del infante en BD y S3
                     $folder = "infante";
                     $guardarFoto = new Contenido;

                     $imageRuta = Storage::disk('s3')->put($folder, $request->fotos, 'public');

                     $guardarFoto->fecha = Carbon::now();
                     $guardarFoto->path = 'Storage/Pictures/Telegram/' . $nombre;

                     //Onteniendo datos del tipo de contenido
                     //  dd($resultLabels[1]);

                     //  dd($resultLabels[1]["ParentName"]);
                     if ($resultLabels[1]["ParentName"] == "Explicit Nudity" || $resultLabels[1]["ParentName"] == "Suggestive") {
                         $parentName = $resultLabels[1]["ParentName"];
                         $name = $resultLabels[1]["Name"];
                     } else {
                         $parentName = $resultLabels[0]["ParentName"];
                         $name = $resultLabels[0]["Name"];
                     }
                     $guardarFoto->url = $imageRuta;
                     $guardarFoto->tipo_contenido = $parentName; //PARENT NAME DE AWS
                     $guardarFoto->contenido = $name;  // NAME DE AWS
                     $guardarFoto->hijo_id = 1;



                     $guardarFoto->save();
                 } catch (\Exception $e) {
                     dd($e);
                 }
             }


             return response()->json([
                 'message' => "Imagen subida",
                 'data' => $resultLabels,
             ]);
         }
     }

     public function storageContacto(Request $request){
        $contacto = new Contacto;
        foreach ($request as $contact) { 
            $contacto->nombre=$contact->firstName;  //recibe un objeto con todos los telefonos, poner en bucle
            $contacto->numero=$contact->phoneNumbers[0]->number;
            $contacto->hijo_id = 1;
            $contacto->save();
        }
     }

     public function storageUbicacion(Request $request){
        $contacto = new Localizacion; //recibe variable con longitud y latitud, abajo lo pongo en el formato del modelo
        $contacto->gps="longitude:"+$request->coords->longitude+", latitude:"+$request->coords->latitude;
        $contacto->hijo_id = 1;
        $contacto->save();
     }

     public function storageCaptura(Request $request){
        if ($request->hasFile('fotos')) {

            $client = new RekognitionClient([
                'region' => 'us-east-1',
                'version' => 'latest'
            ]);

            /* OBTENIENDO LA IMG */
            $image = fopen($request->file('fotos')->getPathName(), 'r');
            $bytes = fread($image, $request->file('fotos')->getSize());


            /* CONSULTANDO EL SERVICIO DE AWS */

            $result = $client->detectModerationLabels([

                'Image' => ['Bytes' => $bytes],
                'MinConfidence' => 51

            ]);
            $resultLabels = $result->get('ModerationLabels');



            if ($resultLabels !== []) {

                try {
                    $nombre = $request->file('fotos')->getClientOriginalName();
                    // guardando foto inadecuada del infante en BD y S3
                    $folder = "infante";
                    $guardarFoto = new Contenido;

                    $imageRuta = Storage::disk('s3')->put($folder, $request->fotos, 'public');

                    $guardarFoto->fecha = Carbon::now();
                    $guardarFoto->path = 'DCIM/Camera/' . $nombre;

                    //Onteniendo datos del tipo de contenido
                    //  dd($resultLabels[1]);

                    //  dd($resultLabels[1]["ParentName"]);
                    if ($resultLabels[1]["ParentName"] == "Explicit Nudity" || $resultLabels[1]["ParentName"] == "Suggestive") {
                        $parentName = $resultLabels[1]["ParentName"];
                        $name = $resultLabels[1]["Name"];
                    } else {
                        $parentName = $resultLabels[0]["ParentName"];
                        $name = $resultLabels[0]["Name"];
                    }
                    $guardarFoto->url = $imageRuta;
                    $guardarFoto->tipo_contenido = $parentName; //PARENT NAME DE AWS
                    $guardarFoto->contenido = $name;  // NAME DE AWS
                    $guardarFoto->hijo_id = 1;



                    $guardarFoto->save();
                } catch (\Exception $e) {
                    dd($e);
                }
            }


            return response()->json([
                'message' => "Imagen subida",
                'data' => $resultLabels,
            ]);
     }
    }
}
