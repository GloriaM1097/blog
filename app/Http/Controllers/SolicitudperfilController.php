<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitudperfil;
use Auth;
use App\Empresa;
use App\Solicitud;
use App\Perfil;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\MensajeSolicitud;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SolicitudperfilController extends Controller
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
    
    public function index()
    {
        //
        abort(404, 'Página No Encontrada');
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
        abort(404, 'Página No Encontrada');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(Auth::user()->origen == 'Empresa'){
            try {
                $decode = Crypt::decryptString($id);
    
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
            $tipo = $id;

        $hola = Solicitudperfil::all()->where('idsolicitud',$tipo)->first();

        $usuario = Auth::user()->id;
        $empresa = Empresa::select('idempresa')->where('users_id', $usuario)->first();
        $empresas = Arr::first($empresa);
        $empresas = Empresa::where('idempresa',$empresa->idempresa)->first();
        $bienvenido = Solicitud::where('idsolicitud',$id)->first();

        $solici = Solicitud::select('idsolicitud')->where('idsolicitud',$id)->get()->pluck('idsolicitud');
        $sola = Arr::first($solici);

        $perfiles = Perfil::all();
        $salu = Solicitud::all();
        $Lista = array();
        foreach($perfiles as $key=>$val){
            $Lista[$key] = $val;
            $array = Solicitudperfil::where('idsolicitud',$id)->where('idperfiles',$val['idperfiles'])->first();            
            if(!empty($array)){
                $Lista[$key]->checked = 'checked';
            }else{
                $Lista[$key]->checked = '';
            }
        }
        
        
        return view('bienvenido.editar',compact('perfiles','empresas','sola','hola','salu','bienvenido'));
        }else{
            abort(404, 'Página No Encontrada');
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
            if(Auth::user()->origen == 'Empresa'){             
           //dd($request);
            $perfilactual = DB::table('solicitudperfil')->where('idsolicitud','=',$request->idsolicitud)->get();
            //dd($perfilactual);
            foreach($perfilactual as $perfileliminar){
                $ideliminar = $perfileliminar->id;
                
                $elimar = Solicitudperfil::find($ideliminar);
                $elimar->delete();
            }
            //dd($perfilactual);
            
            // Ciclo para mostrar las casillas checked checkbox.
                foreach($request->perfil as $selected){                   
                    $nuevoperfil = new Solicitudperfil;
                    $nuevoperfil->idsolicitud = $request->idsolicitud;
                    $nuevoperfil->idperfiles = $selected;
                    $nuevoperfil->created_at = date('Y-m-d H:m:s');
                    $nuevoperfil->updated_at = date('Y-m-d H:m:s');
                    $nuevoperfil->save();

                    $obtencorreo = DB::table('egresado')->where('perfiles_id', $selected)->get();
                    //dd($obtencorreo);
                    foreach($obtencorreo as $correo){
                        $correoobt = $correo->correo;
                        //echo $correoobt;
                        //envio correo
                        $data1 = 'https://bolsadetrabajo.tuxtla.tecnm.mx/BTEgresado';
                        Mail::to($correoobt)->send(new MensajeSolicitud($data1));
                        sleep(1); //para servidor de mailtrap.io de ahi no debe ir
                        
                    }
                }

                // $aviso = Solicitudperfil::whereDate('created_at', '=',new \DateTime('today'))->get();
                // foreach($aviso as $perfil){
                // $obtenperfil = $perfil->idperfiles;
                // //echo $obtenperfil;
                // $obtencorreo = DB::table('egresado')->where('perfiles_id', $obtenperfil)->get();
                // //dd($obtencorreo);
                //     foreach($obtencorreo as $correo){
                //         $correoobt = $correo->correo;
                //         //echo $correoobt;
                //         //envio correo
                //         $data1 = 'https://bolsadetrabajo.tuxtla.tecnm.mx/BTEgresado';
                //         Mail::to($correoobt)->send(new MensajeSolicitud($data1));
                //         sleep(5); //para servidor de mailtrap.io de ahi no debe ir
                        
                //     }
                // }


            //dd($selected1);
           /* $hola = Solicitudperfil::find($id);

            $hola->idsolicitud = $request->idsolicitud;
            $hola->idperfiles = $selected1;

            //dd($hola->idperfiles);
            $hola->save();*/
        
        return redirect()->route('solicitud.index');
        }else{
            abort(404, 'Página No Encontrada');
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
