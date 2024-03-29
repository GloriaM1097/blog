
@extends('administradora.inicio3')
@section('contenido')

<div class="container">      
        <div class="col-sm-10" >

          <div class="panel panel-success"><br>
              <h2 class="panel-title"><center><font size="5"></i>Lista de Usuarios del Sistema</font></center></h2>

            <div class="panel-body">              
                <div class=" col-md-12"> 
                         <center>
                        <form class="form-inline my-3" method="get" action="{{ route ('usuarios-sistema.index') }}">	
                            <input class="form-control" type="search" name="username" placeholder="User Name" aria-label="Search" >
                            
                            <button class="btn btn-success" type="submit">Buscar</button>
                          </form>
                        </center>           
                          <br>
                          <br>
                            <div class="card-body">	
                                <div class="row justify-content-end pb-6">
                                    <a href="{{ url('/usuarios-sistema/create') }}" class="btn btn-success">Registrar Usuario</a>
                                </div>						                        	
                                <table class="table table-hover" style="table-layout: fixed; border-collapse: collapse;">
                                    <thead>
                                        <th>Usuario</th>                                
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach($usuarios as $user)
                                            <tr>
                                                <td>{{ $user->username }}</td>
        
                                                <td>
                                                    <a href="{{ url('/usuarios-sistema/'.$user->id.'/edit') }}" class="btn btn-primary">Editar</a>
                                                    @include('adminusuarios.deleteadmin',['usuario' => $user])
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
          </div>
        </div>
</div>

                      
                     
                  
@endsection