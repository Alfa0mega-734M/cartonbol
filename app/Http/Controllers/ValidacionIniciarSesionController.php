<?php

namespace App\Http\Controllers;

use App\Http\Requests\IniciarSesionFormRequest;
use App\Http\Requests\RegistroFormRequest;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidacionIniciarSesionController extends Controller
{
    public function iniciar_sesion(IniciarSesionFormRequest $request){

        if ( Auth::attempt(['email' => $request->email, 'password' => $request->contrasena ], false) ) {
            return response()->json('Has iniciado sesion', 200);
        } else {
            return response()->json( ['errors' => ['login' => ['El usuario que ingresaste no se encuentra registrado']]], 422);
        }

    }

    public function registro(RegistroFormRequest $request){
        //Primera forma
        //$usuario = new Usuario();
        //$usuario->nombre = $request->nombre;
        //$usuario->email = $request->email;
        //$usuario->password = bcrypt($request->contrasena);
        //$usuario->roles_id = 2;
        //$usuario->save();

        //Segunda forma
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt($request->contrasena),
            'roles_id' => 2,
            'celular' => $request->celular,
        ]);

        //Auth::loginUsingId($usuario->id);  //Par ainiciar automaticamente

        return response()->json($request->all(),200);
    }
}
