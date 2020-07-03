<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;
use DB;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $usuarios = User::name($request->get('username'))->where('origen','Administradora')->get();
        //dd($usuarios);
        return view('adminusuarios.indexadmin', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adminusuarios.createadmin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $usuario = new User;

        $usuario->origen = "Administradora";
        $usuario->username = $request->username;
        $usuario->password =  bcrypt($request->contraseña);
        $usuario->tipo= "0";
        $usuario->curriculo = "0";

        $usuario->save();

        return redirect('/usuarios-sistema');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $usuario = User::findOrFail($id);
        //dd($usuario);
        return view('adminusuarios.editadmin', compact('usuario'));
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
        //
        $usuario = User::findOrFail($id);

        $usuario->username = $request->username;        
        $usuario->password =  bcrypt($request->contraseña);

        $usuario->save();
        return redirect('/usuarios-sistema');
        //dd($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario = User::findOrFail($id);
        //dd($usuario);
        
        //eliminar el usuario
        if($usuario->delete()){
            return redirect('/usuarios-sistema');
        }else{
            return response()->json([
                'mensaje' => 'Error al eliminar el usuario'
            ]);
        }
    }
}