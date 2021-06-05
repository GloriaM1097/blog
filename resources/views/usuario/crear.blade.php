@extends('administradora.inicio3')
@section('contenido')

@if ($existe == 'Si')

<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
    <div class="box box-default">
      <div class="box-header with-border">
        <h5 class="box-title">Aviso:</h5>
      </div><!-- /.box-header -->
      <div class="box-body">
    
       Este correo ya se encuentra registrado!!
       
      </div><!-- /.box-body -->
    </div><!-- /.box -->
    </div>
    
@endif
<div class="container">      
        <div class="col-sm-10" >

          <div class="panel panel-success"><br>
              <h2 class="panel-title"><center><font size="5"></i>Registro De Usuario Nuevo Egresado</font></center></h2>

            <div class="panel-body">              
                <div class=" col-md-12"> 
                    <div class="card">
                                
                        <div class="card-body">
                            <form action="{{route('usuario.store')}}" method="post">
                                @csrf
        
                                {{-- <div class="form-group">                                    
                                    <div class="col-md-6">
                                        <label>User Name:</label>
                                       <input type="text" name="username" required class="form-control" placeholder="User Name"> 
                                    </div>                            
                                </div>
                                
                                <div class="form-group ">                                    
                                    <div class="col-md-6">
                                        <label>Contraseña:</label>
                                       <input type="password" name="password" required class="form-control" placeholder="Password"> 
                                    </div>                            
                                </div>   --}}
                                
                                <div class="form-group ">                                    
                                    <div class="col-md-6">
                                        <label>Correo:</label>
                                       <input type="email" name="email" required class="form-control" placeholder="email"> 
                                    </div>                            
                                </div>  
                                <br>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <br>
                                        <input type="hidden" name="tipo" value="6">
                                      <input type="submit" value="Registrar Usuario" class="btn btn-primary">  
                                    </div>                            
                                </div>
        
                            </form>
                        </div>
                    </div>
                     </div>
                </div>
            </div>
          </div>
        </div>
</div>
                             
@endsection