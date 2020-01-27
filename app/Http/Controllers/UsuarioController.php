<?php

namespace App\Http\Controllers;

use App\Coordinador;
use App\Mail\SendMail;
use App\Operario;
use App\Tecnico;
use App\User;
use App\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    protected static $ERROR_VALIDAR = 'El email ya existe';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario/usuario_create', ['usuario' => Auth::user()]);
    }

    /**
     * Que se tiene que validar.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return $cosa = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
        ]);

    }

    /**
     * Comprueba la validacion de si el email es unico o no
     *
     * @param Request $request
     * @return array|string
     */
    public function register(Request $request)
    {
        try {
            return $this->validator($request->all())->validate();
        } catch (\Exception $e) {
            return self::$ERROR_VALIDAR;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(Request $request)
    {
        //validar el usuario
        $validacion = $this->register($request);
        $resultado = "0";

        // insertar o devolver error
        if ($validacion != self::$ERROR_VALIDAR) {
            //guardar el usuario nuevo
            $usuario = new Usuario;
            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            $usuario->password = Hash::make('12345678');
            $usuario->rol = $request->rol;
            $usuario->save();

            // obtenerlo para guardar en su table especifica
            $user = DB::table('usuarios')
                ->select('*')
                ->orderByDesc('id')
                ->limit(1)
                ->get();
            switch ($request->rol) {
                case 'jefe':
                    $jefe = new Coordinador;
                    $jefe->nombre = $request->nombre;
                    $jefe->apellidos = $request->apellidos;
                    $jefe->telefono = $request->telefono;
                    $jefe->dni = $request->dni;
                    $jefe->email = $request->email;
                    $jefe->usuarios_id = $user[0]->id;
                    $jefe->isJefe = true;
                    $jefe->save();
                    break;
                case 'coordinador':
                    $coordinador = new Coordinador;
                    $coordinador->nombre = $request->nombre;
                    $coordinador->apellidos = $request->apellidos;
                    $coordinador->telefono = $request->telefono;
                    $coordinador->dni = $request->dni;
                    $coordinador->email = $request->email;
                    $coordinador->usuarios_id = $user[0]->id;
                    $coordinador->isJefe = false;
                    $coordinador->save();
                    break;
                case 'tecnico':
                    $tecnico = new Tecnico;
                    $tecnico->nombre = $request->nombre;
                    $tecnico->apellidos = $request->apellidos;
                    $tecnico->telefono = $request->telefono;
                    $tecnico->dni = $request->dni;
                    $tecnico->email = $request->email;
                    $tecnico->usuarios_id = $user[0]->id;
                    $tecnico->taller_id = $request->tallerId;
                    $tecnico->disponibilidad = true;
                    $tecnico->turno = $request->turno;
                    $tecnico->save();
                    break;
                case 'operario':
                    $operario = new Operario;
                    $operario->nombre = $request->nombre;
                    $operario->apellidos = $request->apellidos;
                    $operario->telefono = $request->telefono;
                    $operario->dni = $request->dni;
                    $operario->email = $request->email;
                    $operario->usuarios_id = $user[0]->id;
                    $operario->save();
                    break;
            }
            $resultado = "1";
            // enviar email
            $mail = new MailSendController;
            $mail->nuevoUsuario($request->email, $request->nombre);
        }
        return redirect()->route('usuario.create', ['usuario' => Auth::user(), 'resultado' => $resultado]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public
    function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Request $request)
    {
        switch ($request->modo) {
            case "password":
                return view('usuario/password_edit', ['usuario' => Auth::user()]);
            case "baja":
                return view('usuario/usuario_edit', ['usuario' => Auth::user()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Usuario $usuario
     * @return
     */
    public
    function update(Request $request)
    {
        $resultado = 0;
        // Cambiar contraseña
        $contra1 = $request->contra1;
        $contra2 = $request->contra2;

        // comprobar contraseñas
        if ($contra1 == $contra2) {
            //comprobar con la base de datos
            $usuario = DB::table('usuarios')->select('*')
                ->where('id', Auth::user()->id)
                ->get();
            // contraseña encriptada
            $hashDePasswordActual = $usuario[0]->password;

            // comprobar si coinciden
            if (password_verify($contra1, $hashDePasswordActual)) {
                $nuevaContra = $request->nuevaContra;
                DB::table('usuarios')
                    ->where('id', $usuario[0]->id)
                    ->update(['password' => Hash::make($nuevaContra)]);
                $resultado = 1; //correcto
            }
        }
        return redirect()->route('usuario.password.edit', ['modo' => 'password', 'usuario' => Auth::user(), 'resultado' => $resultado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Usuario $usuario)
    {
        //
    }
}
