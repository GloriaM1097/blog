<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;
use DB;
use App\Empresa;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Mail\MensajeCambioUsuario;

class UserEmpreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        //
        if(Auth::user()->origen == 'Administradora'){
        $usuarios = User::name($request->get('username'))->where('origen','Empresa')->get();
        //dd($usuarios);
        return view('adminusuarios.indexem', compact('usuarios'));
        }else{
            abort(404, 'Página No Encontrada');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort(404, 'Página No Encontrada');
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
        abort(404, 'Página No Encontrada');
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
        try {
            $decode = Crypt::decrypt($id);

            $versiarray = is_array($decode);
    
            if($versiarray == true){
                if($decode[0] == false){
                    $id = $decode[1];
                }else{
                    $id = $decode[0];
                }                   
            }else{
                $id = $decode;
            } 
        } catch (DecryptException $e) {
            abort(404, 'Pagina No Encontrada');
        }

        if(Auth::user()->origen == 'Empresa'){ 
        $usuario = User::findOrFail($id);
        $existe = 'No';
        //dd($usuario);
        $usuario1 = Auth::user()->id;
        $empresa = Empresa::select('idempresa')->where('users_id', $usuario1)->first();
        $empresas = Arr::flatten($empresa);
        $empresas = Empresa::where('idempresa',$empresa->idempresa)->first();
        return view('empresa.editusuario', compact('existe','usuario','empresas'));
        }else{
            abort(404, 'Pagina No Encontrada');
        }
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
        if(Auth::user()->origen == 'Administradora'){
        $usuario = User::findOrFail($id);
        //dd($usuario);
        $existe = 'No';
        return view('adminusuarios.editem', compact('existe','usuario'));
        }else{
            abort(404, 'Página No Encontrada');
        }

    }

    public function edit2($id){
        if (Auth::user()->origen == 'Empresa') {
            try {
                $decode = Crypt::decrypt($id);

                $versiarray = is_array($decode);
        
                if($versiarray == true){
                    if($decode[0] == false){
                        $id = $decode[1];
                    }else{
                        $id = $decode[0];
                    }                   
                }else{
                    $id = $decode;
                } 
            } catch (DecryptException $e) {
                abort(404, 'Pagina No Encontrada');
            }
            $user = DB::table('users')->where('id',$id)->get();
            //dd($user);
            $existe = 'No';
            $usuario1 = Auth::user()->id;
            $empresa = Empresa::select('idempresa')->where('users_id', $usuario1)->first();
            $empresas = Arr::flatten($empresa);
            $empresas = Empresa::where('idempresa',$empresa->idempresa)->first();
            return view('empresa.editcorreo', compact('existe','user','empresas'));
        }else{
            abort(404,'Pagina No Encontrada');
        }
        

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
        if(Auth::user()->origen == 'Empresa'){
            $usuario = User::findOrFail($id);
            $existeuser = DB::table('users')->where('username',$request->username)->exists();
            if($existeuser == true){
                $existe = 'Si';
                $usuario = User::findOrFail($id);
                //dd($usuario);
                $usuario1 = Auth::user()->id;
                $empresa = Empresa::select('idempresa')->where('users_id', $usuario1)->get()->pluck('idempresa');
                $empresas = Arr::flatten($empresa);

                return view('empresa.editusuario', compact('existe','usuario','empresas'));
            }else{
                    //dd($existeuser);
                $contraseña = $request->contraseña;
                $usuario->username = $request->username;
                $usuario->password =  bcrypt($request->contraseña);

                //correo de aviso cambio de usuario
            
                    $correoeg = $usuario->email;

                    // $data= array(
                    //     'mensaje' => 'Ingresa',
                    //     'direccion' => 'http://127.0.0.1:8000/BTEmpresa',
                    //     'usuario' => $request->username,
                    //     'contraseña' => $contraseña,
                    // );

                    //     Mail::send('emails.webcambioUser',$data,function($msg) use ($correoeg){
                    //         $msg->from('from@example.com', 'Bolsa de Trabajo ITTG');

                    //         $msg->to($correoeg)->subject('Notificacion');
                    //     });

                    $data1 = $request->username;
                    $data = $contraseña;
            
                    Mail::to($correoeg)->send(new MensajeCambioUsuario($data1, $data));
                    //dd($correoem);

                $usuario->save();
                return redirect('/empresa');
            }
            
        }
        if(Auth::user()->origen == 'Administradora'){
        $usuario = User::findOrFail($id);

        $usuario = User::findOrFail($id);
            $existeuser = DB::table('users')->where('username',$request->username)->exists();
            if($existeuser == true){
                $existe = 'Si';
                $usuario = User::findOrFail($id);
                //dd($usuario);
               
                return view('adminusuarios.editem', compact('existe','usuario'));

                
            }else{
                $contraseña = $request->contraseña;

                $usuario->username = $request->username;
                $usuario->password =  bcrypt($request->contraseña);
                //$usuario->email = $request->email;
        
                 //correo de aviso cambio de usuario
                 
                 $correoeg = $usuario->email;
        
                //  $data= array(
                //      'mensaje' => 'Ingresa',
                //      'direccion' => 'http://127.0.0.1:8000/BTEmpresa',
                //      'usuario' => $request->username,
                //      'contraseña' => $contraseña,
                //  );
        
                //      Mail::send('emails.webcambioUser',$data,function($msg) use ($correoeg){
                //          $msg->from('from@example.com', 'Bolsa de Trabajo ITTG');
        
                //          $msg->to($correoeg)->subject('Notificacion');
                //      });
                // //dd($correoem);
                $data1 = $request->username;
                $data = $contraseña;
        
                Mail::to($correoeg)->send(new MensajeCambioUsuario($data1, $data));
        
                $usuario->save();
                return redirect('/usuarios-empresa');
                //dd($usuario);
            }
       
        }else{
            abort(404, 'Página No Encontrada');
        }
    }

    public function update2(Request $request,$id){
        
        $user = User::findOrFail($id);
        $existecorre = DB::table('users')->where('email', $request->email)->exists();
        if($existecorre == true){
            $user = DB::table('users')->where('id',$id)->get();
            //dd($user);
            $existe = 'Si';
            $usuario1 = Auth::user()->id;
            $empresa = Empresa::select('idempresa')->where('users_id', $usuario1)->get()->pluck('idempresa');
            $empresas = Arr::flatten($empresa);
            return view('empresa.editcorreo', compact('existe','user','empresas'));
        }else{
            //dd($user);
            $user = User::findOrFail($id);
            $user->email = $request->email;
            $user->email_verified_at = null;
            $userid = Auth::user()->id;
            $Ucorreo1 = Empresa::select('idempresa')->where('users_id', $userid)->first();

            //dd($Ucorreo1);
            $Ucorreo = Empresa::findOrFail($Ucorreo1->idempresa); 
            //dd($Ucorreo); 
            $Ucorreo->email =$request->email;
            
            // dd($Ucorreo[0]->email);
            $Ucorreo->save();
            $user->save();
            
            return redirect()->route('empresa.index');
        }      
        
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
        abort(404, 'Página No Encontrada');
    }
}
