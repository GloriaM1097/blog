<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

use Auth;
use Session;
use App\User;

class logearController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $request = $request->input();
            if(Auth::attempt(['username'=>$request['username'],'password'=>$request['password']])){
                if (Auth::user()->origen=='Egresado'){
                    return Redirect::to('egresado');
                }else{
                    return back()->with('message','Correo o Contraseña Invalido');
                }
            }
        }
        return view('egresado.login');
    }

    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'username';
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/BTEgresado')->with('flash_message_success','Sesion Finalizada');
    }    
}